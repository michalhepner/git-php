<?php

namespace MichalHepner\Git;

use FilesystemIterator;
use MichalHepner\Git\Command;
use MichalHepner\Git\Command\Command as CommandInterface;
use MichalHepner\Git\Infrastructure\EventDispatcher\EventDispatcherAwareTrait;
use MichalHepner\Git\Infrastructure\ProcessFactory\ProcessFactoryInterface;
use MichalHepner\Git\Infrastructure\ProcessFactory\SymfonyProcessFactory;
use MichalHepner\Git\Repository\Branch;
use RuntimeException;
use SplFileInfo;
use Symfony\Component\Filesystem\Filesystem;

class Git
{
    use EventDispatcherAwareTrait;

    public function __construct(
        protected ?ProcessFactoryInterface $processFactory,
        protected string $gitBinary = 'git',
        protected int $commandTimeout = 600,
        protected array $env = [],
        protected ?Filesystem $filesystem = null,
    ) {
        $this->processFactory = $processFactory ?? new SymfonyProcessFactory();
        $this->filesystem = $filesystem ?? new Filesystem();
    }

    public function init(string|SplFileInfo $path, array $options = []): Repository
    {
        $path = $path instanceof SplFileInfo ? $path->getPathname() : $path;
        !$this->filesystem->exists($path) && $this->filesystem->mkdir($path);
        $this->executeCommand(new Command\InitCommand($this->processFactory, $path, '.', $options, $this->env));

        return $this->loadRepository($path);
    }

    public function clone(string $repository, string $dir, array $options = []): Repository
    {
        !$this->filesystem->exists($dir) && $this->filesystem->mkdir($dir);
        if ((new FilesystemIterator($dir))->valid()) {
            throw new RuntimeException(sprintf('Can\'t clone into %s, directory is not empty', $dir));
        }

        $this->executeCommand(new Command\CloneCommand($this->processFactory, $dir, [$repository, '.'], $options, $this->env));

        return $this->loadRepository($dir);
    }

    public function load(string|SplFileInfo $dir): Repository
    {
        return $this->loadRepository($dir instanceof SplFileInfo ? $dir->getPathname() : $dir);
    }

    public function addCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\AddCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function add(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->addCommand($path, $spec, $options));
    }

    public function amCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\AmCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function am(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->amCommand($path, $spec, $options));
    }

    public function annotateCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\AnnotateCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function annotate(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->annotateCommand($path, $spec, $options));
    }

    public function applyCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ApplyCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function apply(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->applyCommand($path, $spec, $options));
    }

    public function archimportCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ArchimportCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function archimport(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->archimportCommand($path, $spec, $options));
    }

    public function archiveCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ArchiveCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function archive(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->archiveCommand($path, $spec, $options));
    }

    public function bisectCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\BisectCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function bisect(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->bisectCommand($path, $subCommand, $spec, $options));
    }

    public function blameCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\BlameCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function blame(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->blameCommand($path, $spec, $options));
    }

    public function branchCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\BranchCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function branch(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->branchCommand($path, $spec, $options));
    }

    public function bugreportCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\BugreportCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function bugreport(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->bugreportCommand($path, $spec, $options));
    }

    public function bundleCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\BundleCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function bundle(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->bundleCommand($path, $subCommand, $spec, $options));
    }

    public function catFileCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CatFileCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function catFile(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->catFileCommand($path, $spec, $options));
    }

    public function checkAttrCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CheckAttrCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function checkAttr(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->checkAttrCommand($path, $spec, $options));
    }

    public function checkIgnoreCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CheckIgnoreCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function checkIgnore(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->checkIgnoreCommand($path, $spec, $options));
    }

    public function checkMailmapCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CheckMailmapCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function checkMailmap(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->checkMailmapCommand($path, $spec, $options));
    }

    public function checkRefFormatCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CheckRefFormatCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function checkRefFormat(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->checkRefFormatCommand($path, $spec, $options));
    }

    public function checkoutCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CheckoutCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function checkout(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->checkoutCommand($path, $spec, $options));
    }

    public function checkoutIndexCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CheckoutIndexCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function checkoutIndex(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->checkoutIndexCommand($path, $spec, $options));
    }

    public function cherryCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CherryCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function cherry(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->cherryCommand($path, $spec, $options));
    }

    public function cherryPickCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CherryPickCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function cherryPick(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->cherryPickCommand($path, $spec, $options));
    }

    public function cleanCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CleanCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function clean(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->cleanCommand($path, $spec, $options));
    }

    public function columnCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ColumnCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function column(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->columnCommand($path, $spec, $options));
    }

    public function commitCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CommitCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function commit(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->commitCommand($path, $spec, $options));
    }

    public function commitTreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CommitTreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function commitTree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->commitTreeCommand($path, $spec, $options));
    }

    public function configCommand(string|SplFileInfo $path, ?string $fileOption = null, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ConfigCommand($this->processFactory, $path, $fileOption, $spec, $options, $this->env));
    }

    public function config(string|SplFileInfo $path, ?string $fileOption = null, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->configCommand($path, $fileOption, $spec, $options));
    }

    public function countObjectsCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CountObjectsCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function countObjects(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->countObjectsCommand($path, $spec, $options));
    }

    public function cvsexportcommitCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CvsexportcommitCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function cvsexportcommit(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->cvsexportcommitCommand($path, $spec, $options));
    }

    public function cvsimportCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\CvsimportCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function cvsimport(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->cvsimportCommand($path, $spec, $options));
    }

    public function describeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\DescribeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function describe(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->describeCommand($path, $spec, $options));
    }

    public function diffCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\DiffCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function diff(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->diffCommand($path, $spec, $options));
    }

    public function diffFilesCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\DiffFilesCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function diffFiles(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->diffFilesCommand($path, $spec, $options));
    }

    public function diffIndexCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\DiffIndexCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function diffIndex(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->diffIndexCommand($path, $spec, $options));
    }

    public function diffTreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\DiffTreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function diffTree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->diffTreeCommand($path, $spec, $options));
    }

    public function difftoolCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\DifftoolCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function difftool(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->difftoolCommand($path, $spec, $options));
    }

    public function fastExportCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FastExportCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function fastExport(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->fastExportCommand($path, $spec, $options));
    }

    public function fastImportCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FastImportCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function fastImport(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->fastImportCommand($path, $spec, $options));
    }

    public function fetchCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FetchCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function fetch(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->fetchCommand($path, $spec, $options));
    }

    public function fetchPackCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FetchPackCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function fetchPack(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->fetchPackCommand($path, $spec, $options));
    }

    public function fmtMergeMsgCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FmtMergeMsgCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function fmtMergeMsg(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->fmtMergeMsgCommand($path, $spec, $options));
    }

    public function forEachRefCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ForEachRefCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function forEachRef(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->forEachRefCommand($path, $spec, $options));
    }

    public function formatPatchCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FormatPatchCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function formatPatch(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->formatPatchCommand($path, $spec, $options));
    }

    public function fsckCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\FsckCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function fsck(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->fsckCommand($path, $spec, $options));
    }

    public function gcCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\GcCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function gc(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->gcCommand($path, $spec, $options));
    }

    public function getTarCommitIdCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\GetTarCommitIdCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function getTarCommitId(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->getTarCommitIdCommand($path, $spec, $options));
    }

    public function grepCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\GrepCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function grep(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->grepCommand($path, $spec, $options));
    }

    public function hashObjectCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\HashObjectCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function hashObject(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->hashObjectCommand($path, $spec, $options));
    }

    public function imapSendCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ImapSendCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function imapSend(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->imapSendCommand($path, $spec, $options));
    }

    public function indexPackCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\IndexPackCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function indexPack(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->indexPackCommand($path, $spec, $options));
    }

    public function interpretTrailersCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\InterpretTrailersCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function interpretTrailers(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->interpretTrailersCommand($path, $spec, $options));
    }

    public function logCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\LogCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function log(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->logCommand($path, $spec, $options));
    }

    public function lsFilesCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\LsFilesCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function lsFiles(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->lsFilesCommand($path, $spec, $options));
    }

    public function lsRemoteCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\LsRemoteCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function lsRemote(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->lsRemoteCommand($path, $spec, $options));
    }

    public function lsTreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\LsTreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function lsTree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->lsTreeCommand($path, $spec, $options));
    }

    public function mailinfoCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MailinfoCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mailinfo(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mailinfoCommand($path, $spec, $options));
    }

    public function mailsplitCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MailsplitCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mailsplit(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mailsplitCommand($path, $spec, $options));
    }

    public function maintenanceCommand(string|SplFileInfo $path, string $subCommand, string $task, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MaintenanceCommand($this->processFactory, $path, $subCommand, $task, $spec, $options, $this->env));
    }

    public function maintenance(string|SplFileInfo $path, string $subCommand, string $task, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->maintenanceCommand($path, $subCommand, $task, $spec, $options));
    }

    public function mergeBaseCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MergeBaseCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mergeBase(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mergeBaseCommand($path, $spec, $options));
    }

    public function mergeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MergeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function merge(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mergeCommand($path, $spec, $options));
    }

    public function mergeFileCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MergeFileCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mergeFile(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mergeFileCommand($path, $spec, $options));
    }

    public function mergeOneFileCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MergeOneFileCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mergeOneFile(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mergeOneFileCommand($path, $spec, $options));
    }

    public function mergeTreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MergeTreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mergeTree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mergeTreeCommand($path, $spec, $options));
    }

    public function mktagCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MktagCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mktag(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mktagCommand($path, $spec, $options));
    }

    public function mktreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MktreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mktree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mktreeCommand($path, $spec, $options));
    }

    public function mvCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\MvCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function mv(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->mvCommand($path, $spec, $options));
    }

    public function nameRevCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\NameRevCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function nameRev(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->nameRevCommand($path, $spec, $options));
    }

    public function notesCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\NotesCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function notes(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->notesCommand($path, $subCommand, $spec, $options));
    }

    public function packRefsCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\PackRefsCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function packRefs(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->packRefsCommand($path, $spec, $options));
    }

    public function patchIdCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\PatchIdCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function patchId(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->patchIdCommand($path, $spec, $options));
    }

    public function pruneCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\PruneCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function prune(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->pruneCommand($path, $spec, $options));
    }

    public function prunePackedCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\PrunePackedCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function prunePacked(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->prunePackedCommand($path, $spec, $options));
    }

    public function pullCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\PullCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function pull(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->pullCommand($path, $spec, $options));
    }

    public function pushCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\PushCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function push(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->pushCommand($path, $spec, $options));
    }

    public function quiltimportCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\QuiltimportCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function quiltimport(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->quiltimportCommand($path, $spec, $options));
    }

    public function rangeDiffCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RangeDiffCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function rangeDiff(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->rangeDiffCommand($path, $spec, $options));
    }

    public function readTreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ReadTreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function readTree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->readTreeCommand($path, $spec, $options));
    }

    public function rebaseCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RebaseCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function rebase(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->rebaseCommand($path, $spec, $options));
    }

    public function reflogCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ReflogCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function reflog(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->reflogCommand($path, $subCommand, $spec, $options));
    }

    public function remoteCommand(string|SplFileInfo $path, ?string $subCommand = null, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RemoteCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function remote(string|SplFileInfo $path, ?string $subCommand = null, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->remoteCommand($path, $subCommand, $spec, $options));
    }

    public function repackCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RepackCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function repack(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->repackCommand($path, $spec, $options));
    }

    public function replaceCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ReplaceCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function replace(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->replaceCommand($path, $spec, $options));
    }

    public function requestPullCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RequestPullCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function requestPull(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->requestPullCommand($path, $spec, $options));
    }

    public function rerereCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RerereCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function rerere(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->rerereCommand($path, $subCommand, $spec, $options));
    }

    public function resetCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ResetCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function reset(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->resetCommand($path, $spec, $options));
    }

    public function restoreCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RestoreCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function restore(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->restoreCommand($path, $spec, $options));
    }

    public function revListCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RevListCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function revList(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->revListCommand($path, $spec, $options));
    }

    public function revParseCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RevParseCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function revParse(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->revParseCommand($path, $spec, $options));
    }

    public function revertCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RevertCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function revert(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->revertCommand($path, $spec, $options));
    }

    public function rmCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\RmCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function rm(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->rmCommand($path, $spec, $options));
    }

    public function sendEmailCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\SendEmailCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function sendEmail(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->sendEmailCommand($path, $spec, $options));
    }

    public function sendPackCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\SendPackCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function sendPack(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->sendPackCommand($path, $spec, $options));
    }

    public function shortlogCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ShortlogCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function shortlog(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->shortlogCommand($path, $spec, $options));
    }

    public function showBranchCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ShowBranchCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function showBranch(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->showBranchCommand($path, $spec, $options));
    }

    public function showCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ShowCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function show(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->showCommand($path, $spec, $options));
    }

    public function showIndexCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ShowIndexCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function showIndex(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->showIndexCommand($path, $spec, $options));
    }

    public function showRefCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\ShowRefCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function showRef(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->showRefCommand($path, $spec, $options));
    }

    public function sparseCheckoutCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\SparseCheckoutCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function sparseCheckout(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->sparseCheckoutCommand($path, $subCommand, $spec, $options));
    }

    public function stashCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\StashCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function stash(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->stashCommand($path, $subCommand, $spec, $options));
    }

    public function statusCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\StatusCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function status(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->statusCommand($path, $spec, $options));
    }

    public function stripspaceCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\StripspaceCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function stripspace(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->stripspaceCommand($path, $spec, $options));
    }

    public function switchCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\SwitchCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function switch(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->switchCommand($path, $spec, $options));
    }

    public function symbolicRefCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\SymbolicRefCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function symbolicRef(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->symbolicRefCommand($path, $spec, $options));
    }

    public function tagCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\TagCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function tag(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->tagCommand($path, $spec, $options));
    }

    public function unpackFileCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\UnpackFileCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function unpackFile(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->unpackFileCommand($path, $spec, $options));
    }

    public function unpackObjectsCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\UnpackObjectsCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function unpackObjects(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->unpackObjectsCommand($path, $spec, $options));
    }

    public function updateIndexCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\UpdateIndexCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function updateIndex(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->updateIndexCommand($path, $spec, $options));
    }

    public function updateServerInfoCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\UpdateServerInfoCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function updateServerInfo(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->updateServerInfoCommand($path, $spec, $options));
    }

    public function varCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\VarCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function var(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->varCommand($path, $spec, $options));
    }

    public function verifyCommitCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\VerifyCommitCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function verifyCommit(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->verifyCommitCommand($path, $spec, $options));
    }

    public function verifyPackCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\VerifyPackCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function verifyPack(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->verifyPackCommand($path, $spec, $options));
    }

    public function verifyTagCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\VerifyTagCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function verifyTag(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->verifyTagCommand($path, $spec, $options));
    }

    public function whatchangedCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\WhatchangedCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function whatchanged(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->whatchangedCommand($path, $spec, $options));
    }

    public function worktreeCommand(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\WorktreeCommand($this->processFactory, $path, $subCommand, $spec, $options, $this->env));
    }

    public function worktree(string|SplFileInfo $path, string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->worktreeCommand($path, $subCommand, $spec, $options));
    }

    public function writeTreeCommand(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): CommandInterface
    {
        return $this->prepareCommand(new Command\WriteTreeCommand($this->processFactory, $path, $spec, $options, $this->env));
    }

    public function writeTree(string|SplFileInfo $path, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->executeCommand($this->writeTreeCommand($path, $spec, $options));
    }

    public function getGitBinary(): string
    {
        return $this->gitBinary;
    }

    public function setGitBinary(string $gitBinary): void
    {
        $this->gitBinary = $gitBinary;
    }

    public function getEnv(): array
    {
        return $this->env;
    }

    public function setEnv(array $env): void
    {
        $this->env = $env;
    }

    public function getCommandTimeout(): int
    {
        return $this->commandTimeout;
    }

    public function setCommandTimeout(int $commandTimeout): void
    {
        $this->commandTimeout = $commandTimeout;
    }

    protected function prepareCommand(CommandInterface $command): CommandInterface
    {
        $command->setGitBinary($this->gitBinary);
        $command->setTimeout($this->commandTimeout);

        return $command;
    }

    protected function executeCommand(CommandInterface $command): string
    {
        if ($command->execute()) {
            throw new RuntimeException(sprintf(
                "Command \"%s\" exited with non-zero code %d.\nOutput: %s\nError output: %s",
                $command->getRawCommand(),
                $command->getExitCode(),
                $command->getOutput(),
                $command->getErrorOutput(),
            ));
        }

        return $command->getOutput();
    }

    protected function loadRepository(string $dir): Repository
    {
        $repository = new Repository($dir, $this);
        $this->dispatcher && $repository->setDispatcher($this->dispatcher);

        $repository->validate();

        return $repository;
    }
}
