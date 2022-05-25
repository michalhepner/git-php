<?php
declare(strict_types=1);

namespace MichalHepner\Git;

use FilesystemIterator;
use MichalHepner\Git\Command\Command;
use MichalHepner\Git\Exception\RepositoryException;
use MichalHepner\Git\Infrastructure\EventDispatcher\EventDispatcherAwareTrait;
use MichalHepner\Git\Repository\Api;
use Symfony\Component\Filesystem\Filesystem;

class Repository
{
    use EventDispatcherAwareTrait;

    /**
     * @var callable[]
     */
    protected array $onDestroy = [];

    public function __construct(protected string $path, protected Git $git, protected ?Filesystem $filesystem = null)
    {
        $this->filesystem = $filesystem ?? new Filesystem();
    }

    public function __destruct()
    {
        foreach ($this->onDestroy as $callable) {
            $callable($this);
        }
    }

    public function api(): Api
    {
        return new Api($this);
    }

    public function add(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->add($this->path, $spec, $options);
    }

    public function addCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->addCommand($this->path, $spec, $options);
    }

    public function am(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->am($this->path, $spec, $options);
    }

    public function amCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->amCommand($this->path, $spec, $options);
    }

    public function annotate(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->annotate($this->path, $spec, $options);
    }

    public function annotateCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->annotateCommand($this->path, $spec, $options);
    }

    public function apply(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->apply($this->path, $spec, $options);
    }

    public function applyCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->applyCommand($this->path, $spec, $options);
    }

    public function archimport(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->archimport($this->path, $spec, $options);
    }

    public function archimportCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->archimportCommand($this->path, $spec, $options);
    }

    public function archive(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->archive($this->path, $spec, $options);
    }

    public function archiveCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->archiveCommand($this->path, $spec, $options);
    }

    public function bisect(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->bisect($this->path, $subCommand, $spec, $options);
    }

    public function bisectCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->bisectCommand($this->path, $subCommand, $spec, $options);
    }

    public function blame(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->blame($this->path, $spec, $options);
    }

    public function blameCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->blameCommand($this->path, $spec, $options);
    }

    public function branch(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->branch($this->path, $spec, $options);
    }

    public function branchCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->branchCommand($this->path, $spec, $options);
    }

    public function bugreport(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->bugreport($this->path, $spec, $options);
    }

    public function bugreportCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->bugreportCommand($this->path, $spec, $options);
    }

    public function bundle(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->bundle($this->path, $subCommand, $spec, $options);
    }

    public function bundleCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->bundleCommand($this->path, $subCommand, $spec, $options);
    }

    public function catFile(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->catFile($this->path, $spec, $options);
    }

    public function catFileCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->catFileCommand($this->path, $spec, $options);
    }

    public function checkAttr(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->checkAttr($this->path, $spec, $options);
    }

    public function checkAttrCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->checkAttrCommand($this->path, $spec, $options);
    }

    public function checkIgnore(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->checkIgnore($this->path, $spec, $options);
    }

    public function checkIgnoreCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->checkIgnoreCommand($this->path, $spec, $options);
    }

    public function checkMailmap(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->checkMailmap($this->path, $spec, $options);
    }

    public function checkMailmapCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->checkMailmapCommand($this->path, $spec, $options);
    }

    public function checkRefFormat(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->checkRefFormat($this->path, $spec, $options);
    }

    public function checkRefFormatCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->checkRefFormatCommand($this->path, $spec, $options);
    }

    public function checkout(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->checkout($this->path, $spec, $options);
    }

    public function checkoutCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->checkoutCommand($this->path, $spec, $options);
    }

    public function checkoutIndex(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->checkoutIndex($this->path, $spec, $options);
    }

    public function checkoutIndexCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->checkoutIndexCommand($this->path, $spec, $options);
    }

    public function cherry(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->cherry($this->path, $spec, $options);
    }

    public function cherryCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->cherryCommand($this->path, $spec, $options);
    }

    public function cherryPick(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->cherryPick($this->path, $spec, $options);
    }

    public function cherryPickCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->cherryPickCommand($this->path, $spec, $options);
    }

    public function clean(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->clean($this->path, $spec, $options);
    }

    public function cleanCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->cleanCommand($this->path, $spec, $options);
    }

    public function column(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->column($this->path, $spec, $options);
    }

    public function columnCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->columnCommand($this->path, $spec, $options);
    }

    public function commit(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->commit($this->path, $spec, $options);
    }

    public function commitCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->commitCommand($this->path, $spec, $options);
    }

    public function commitTree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->commitTree($this->path, $spec, $options);
    }

    public function commitTreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->commitTreeCommand($this->path, $spec, $options);
    }

    public function config(?string $fileOption = null, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->config($this->path, $fileOption, $spec, $options);
    }

    public function configCommand(?string $fileOption = null, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->configCommand($this->path, $fileOption, $spec, $options);
    }

    public function countObjects(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->countObjects($this->path, $spec, $options);
    }

    public function countObjectsCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->countObjectsCommand($this->path, $spec, $options);
    }

    public function cvsexportcommit(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->cvsexportcommit($this->path, $spec, $options);
    }

    public function cvsexportcommitCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->cvsexportcommitCommand($this->path, $spec, $options);
    }

    public function cvsimport(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->cvsimport($this->path, $spec, $options);
    }

    public function cvsimportCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->cvsimportCommand($this->path, $spec, $options);
    }

    public function describe(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->describe($this->path, $spec, $options);
    }

    public function describeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->describeCommand($this->path, $spec, $options);
    }

    public function diff(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->diff($this->path, $spec, $options);
    }

    public function diffCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->diffCommand($this->path, $spec, $options);
    }

    public function diffFiles(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->diffFiles($this->path, $spec, $options);
    }

    public function diffFilesCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->diffFilesCommand($this->path, $spec, $options);
    }

    public function diffIndex(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->diffIndex($this->path, $spec, $options);
    }

    public function diffIndexCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->diffIndexCommand($this->path, $spec, $options);
    }

    public function diffTree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->diffTree($this->path, $spec, $options);
    }

    public function diffTreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->diffTreeCommand($this->path, $spec, $options);
    }

    public function difftool(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->difftool($this->path, $spec, $options);
    }

    public function difftoolCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->difftoolCommand($this->path, $spec, $options);
    }

    public function fastExport(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->fastExport($this->path, $spec, $options);
    }

    public function fastExportCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->fastExportCommand($this->path, $spec, $options);
    }

    public function fastImport(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->fastImport($this->path, $spec, $options);
    }

    public function fastImportCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->fastImportCommand($this->path, $spec, $options);
    }

    public function fetch(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->fetch($this->path, $spec, $options);
    }

    public function fetchCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->fetchCommand($this->path, $spec, $options);
    }

    public function fetchPack(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->fetchPack($this->path, $spec, $options);
    }

    public function fetchPackCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->fetchPackCommand($this->path, $spec, $options);
    }

    public function fmtMergeMsg(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->fmtMergeMsg($this->path, $spec, $options);
    }

    public function fmtMergeMsgCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->fmtMergeMsgCommand($this->path, $spec, $options);
    }

    public function forEachRef(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->forEachRef($this->path, $spec, $options);
    }

    public function forEachRefCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->forEachRefCommand($this->path, $spec, $options);
    }

    public function formatPatch(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->formatPatch($this->path, $spec, $options);
    }

    public function formatPatchCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->formatPatchCommand($this->path, $spec, $options);
    }

    public function fsck(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->fsck($this->path, $spec, $options);
    }

    public function fsckCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->fsckCommand($this->path, $spec, $options);
    }

    public function gc(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->gc($this->path, $spec, $options);
    }

    public function gcCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->gcCommand($this->path, $spec, $options);
    }

    public function getTarCommitId(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->getTarCommitId($this->path, $spec, $options);
    }

    public function getTarCommitIdCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->getTarCommitIdCommand($this->path, $spec, $options);
    }

    public function grep(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->grep($this->path, $spec, $options);
    }

    public function grepCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->grepCommand($this->path, $spec, $options);
    }

    public function hashObject(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->hashObject($this->path, $spec, $options);
    }

    public function hashObjectCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->hashObjectCommand($this->path, $spec, $options);
    }

    public function imapSend(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->imapSend($this->path, $spec, $options);
    }

    public function imapSendCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->imapSendCommand($this->path, $spec, $options);
    }

    public function indexPack(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->indexPack($this->path, $spec, $options);
    }

    public function indexPackCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->indexPackCommand($this->path, $spec, $options);
    }

    public function interpretTrailers(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->interpretTrailers($this->path, $spec, $options);
    }

    public function interpretTrailersCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->interpretTrailersCommand($this->path, $spec, $options);
    }

    public function log(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->log($this->path, $spec, $options);
    }

    public function logCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->logCommand($this->path, $spec, $options);
    }

    public function lsFiles(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->lsFiles($this->path, $spec, $options);
    }

    public function lsFilesCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->lsFilesCommand($this->path, $spec, $options);
    }

    public function lsRemote(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->lsRemote($this->path, $spec, $options);
    }

    public function lsRemoteCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->lsRemoteCommand($this->path, $spec, $options);
    }

    public function lsTree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->lsTree($this->path, $spec, $options);
    }

    public function lsTreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->lsTreeCommand($this->path, $spec, $options);
    }

    public function mailinfo(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mailinfo($this->path, $spec, $options);
    }

    public function mailinfoCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mailinfoCommand($this->path, $spec, $options);
    }

    public function mailsplit(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mailsplit($this->path, $spec, $options);
    }

    public function mailsplitCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mailsplitCommand($this->path, $spec, $options);
    }

    public function maintenance(string $subCommand, string $task, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->maintenance($this->path, $subCommand, $task, $spec, $options);
    }

    public function maintenanceCommand(string $subCommand, string $task, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->maintenanceCommand($this->path, $subCommand, $task, $spec, $options);
    }

    public function mergeBase(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mergeBase($this->path, $spec, $options);
    }

    public function mergeBaseCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mergeBaseCommand($this->path, $spec, $options);
    }

    public function merge(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->merge($this->path, $spec, $options);
    }

    public function mergeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mergeCommand($this->path, $spec, $options);
    }

    public function mergeFile(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mergeFile($this->path, $spec, $options);
    }

    public function mergeFileCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mergeFileCommand($this->path, $spec, $options);
    }

    public function mergeOneFile(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mergeOneFile($this->path, $spec, $options);
    }

    public function mergeOneFileCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mergeOneFileCommand($this->path, $spec, $options);
    }

    public function mergeTree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mergeTree($this->path, $spec, $options);
    }

    public function mergeTreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mergeTreeCommand($this->path, $spec, $options);
    }

    public function mktag(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mktag($this->path, $spec, $options);
    }

    public function mktagCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mktagCommand($this->path, $spec, $options);
    }

    public function mktree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mktree($this->path, $spec, $options);
    }

    public function mktreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mktreeCommand($this->path, $spec, $options);
    }

    public function mv(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->mv($this->path, $spec, $options);
    }

    public function mvCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->mvCommand($this->path, $spec, $options);
    }

    public function nameRev(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->nameRev($this->path, $spec, $options);
    }

    public function nameRevCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->nameRevCommand($this->path, $spec, $options);
    }

    public function notes(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->notes($this->path, $subCommand, $spec, $options);
    }

    public function notesCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->notesCommand($this->path, $subCommand, $spec, $options);
    }

    public function packRefs(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->packRefs($this->path, $spec, $options);
    }

    public function packRefsCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->packRefsCommand($this->path, $spec, $options);
    }

    public function patchId(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->patchId($this->path, $spec, $options);
    }

    public function patchIdCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->patchIdCommand($this->path, $spec, $options);
    }

    public function prune(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->prune($this->path, $spec, $options);
    }

    public function pruneCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->pruneCommand($this->path, $spec, $options);
    }

    public function prunePacked(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->prunePacked($this->path, $spec, $options);
    }

    public function prunePackedCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->prunePackedCommand($this->path, $spec, $options);
    }

    public function pull(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->pull($this->path, $spec, $options);
    }

    public function pullCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->pullCommand($this->path, $spec, $options);
    }

    public function push(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->push($this->path, $spec, $options);
    }

    public function pushCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->pushCommand($this->path, $spec, $options);
    }

    public function quiltimport(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->quiltimport($this->path, $spec, $options);
    }

    public function quiltimportCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->quiltimportCommand($this->path, $spec, $options);
    }

    public function rangeDiff(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->rangeDiff($this->path, $spec, $options);
    }

    public function rangeDiffCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->rangeDiffCommand($this->path, $spec, $options);
    }

    public function readTree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->readTree($this->path, $spec, $options);
    }

    public function readTreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->readTreeCommand($this->path, $spec, $options);
    }

    public function rebase(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->rebase($this->path, $spec, $options);
    }

    public function rebaseCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->rebaseCommand($this->path, $spec, $options);
    }

    public function reflog(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->reflog($this->path, $subCommand, $spec, $options);
    }

    public function reflogCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->reflogCommand($this->path, $subCommand, $spec, $options);
    }

    public function remote(null|string $subCommand = null, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->remote($this->path, $subCommand, $spec, $options);
    }

    public function remoteCommand(string $subCommand = null, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->remoteCommand($this->path, $subCommand, $spec, $options);
    }

    public function repack(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->repack($this->path, $spec, $options);
    }

    public function repackCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->repackCommand($this->path, $spec, $options);
    }

    public function replace(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->replace($this->path, $spec, $options);
    }

    public function replaceCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->replaceCommand($this->path, $spec, $options);
    }

    public function requestPull(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->requestPull($this->path, $spec, $options);
    }

    public function requestPullCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->requestPullCommand($this->path, $spec, $options);
    }

    public function rerere(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->rerere($this->path, $subCommand, $spec, $options);
    }

    public function rerereCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->rerereCommand($this->path, $subCommand, $spec, $options);
    }

    public function reset(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->reset($this->path, $spec, $options);
    }

    public function resetCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->resetCommand($this->path, $spec, $options);
    }

    public function restore(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->restore($this->path, $spec, $options);
    }

    public function restoreCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->restoreCommand($this->path, $spec, $options);
    }

    public function revList(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->revList($this->path, $spec, $options);
    }

    public function revListCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->revListCommand($this->path, $spec, $options);
    }

    public function revParse(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->revParse($this->path, $spec, $options);
    }

    public function revParseCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->revParseCommand($this->path, $spec, $options);
    }

    public function revert(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->revert($this->path, $spec, $options);
    }

    public function revertCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->revertCommand($this->path, $spec, $options);
    }

    public function rm(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->rm($this->path, $spec, $options);
    }

    public function rmCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->rmCommand($this->path, $spec, $options);
    }

    public function sendEmail(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->sendEmail($this->path, $spec, $options);
    }

    public function sendEmailCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->sendEmailCommand($this->path, $spec, $options);
    }

    public function sendPack(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->sendPack($this->path, $spec, $options);
    }

    public function sendPackCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->sendPackCommand($this->path, $spec, $options);
    }

    public function shortlog(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->shortlog($this->path, $spec, $options);
    }

    public function shortlogCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->shortlogCommand($this->path, $spec, $options);
    }

    public function showBranch(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->showBranch($this->path, $spec, $options);
    }

    public function showBranchCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->showBranchCommand($this->path, $spec, $options);
    }

    public function show(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->show($this->path, $spec, $options);
    }

    public function showCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->showCommand($this->path, $spec, $options);
    }

    public function showIndex(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->showIndex($this->path, $spec, $options);
    }

    public function showIndexCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->showIndexCommand($this->path, $spec, $options);
    }

    public function showRef(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->showRef($this->path, $spec, $options);
    }

    public function showRefCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->showRefCommand($this->path, $spec, $options);
    }

    public function sparseCheckout(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->sparseCheckout($this->path, $subCommand, $spec, $options);
    }

    public function sparseCheckoutCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->sparseCheckoutCommand($this->path, $subCommand, $spec, $options);
    }

    public function stash(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->stash($this->path, $subCommand, $spec, $options);
    }

    public function stashCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->stashCommand($this->path, $subCommand, $spec, $options);
    }

    public function status(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->status($this->path, $spec, $options);
    }

    public function statusCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->statusCommand($this->path, $spec, $options);
    }

    public function stripspace(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->stripspace($this->path, $spec, $options);
    }

    public function stripspaceCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->stripspaceCommand($this->path, $spec, $options);
    }

    public function switch(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->switch($this->path, $spec, $options);
    }

    public function switchCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->switchCommand($this->path, $spec, $options);
    }

    public function symbolicRef(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->symbolicRef($this->path, $spec, $options);
    }

    public function symbolicRefCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->symbolicRefCommand($this->path, $spec, $options);
    }

    public function tag(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->tag($this->path, $spec, $options);
    }

    public function tagCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->tagCommand($this->path, $spec, $options);
    }

    public function unpackFile(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->unpackFile($this->path, $spec, $options);
    }

    public function unpackFileCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->unpackFileCommand($this->path, $spec, $options);
    }

    public function unpackObjects(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->unpackObjects($this->path, $spec, $options);
    }

    public function unpackObjectsCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->unpackObjectsCommand($this->path, $spec, $options);
    }

    public function updateIndex(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->updateIndex($this->path, $spec, $options);
    }

    public function updateIndexCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->updateIndexCommand($this->path, $spec, $options);
    }

    public function updateServerInfo(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->updateServerInfo($this->path, $spec, $options);
    }

    public function updateServerInfoCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->updateServerInfoCommand($this->path, $spec, $options);
    }

    public function var(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->var($this->path, $spec, $options);
    }

    public function varCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->varCommand($this->path, $spec, $options);
    }

    public function verifyCommit(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->verifyCommit($this->path, $spec, $options);
    }

    public function verifyCommitCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->verifyCommitCommand($this->path, $spec, $options);
    }

    public function verifyPack(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->verifyPack($this->path, $spec, $options);
    }

    public function verifyPackCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->verifyPackCommand($this->path, $spec, $options);
    }

    public function verifyTag(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->verifyTag($this->path, $spec, $options);
    }

    public function verifyTagCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->verifyTagCommand($this->path, $spec, $options);
    }

    public function whatchanged(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->whatchanged($this->path, $spec, $options);
    }

    public function whatchangedCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->whatchangedCommand($this->path, $spec, $options);
    }

    public function worktree(string $subCommand, string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->worktree($this->path, $subCommand, $spec, $options);
    }

    public function worktreeCommand(string $subCommand, string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->worktreeCommand($this->path, $subCommand, $spec, $options);
    }

    public function writeTree(string|Ref|array|null $spec = null, array $options = []): string
    {
        return $this->git->writeTree($this->path, $spec, $options);
    }

    public function writeTreeCommand(string|Ref|array|null $spec = null, array $options = []): Command
    {
        return $this->git->writeTreeCommand($this->path, $spec, $options);
    }

    public function validate(): void
    {
        if (!$this->filesystem->exists($this->path)) {
            throw new RepositoryException($this, sprintf(
                'Not a valid repo at %s, the directory does not exist',
                $this->path
            ));
        }

        if (!$this->filesystem->exists($this->path . DIRECTORY_SEPARATOR . '.git')) {
            throw new RepositoryException($this, sprintf(
                'Not a valid repo at %s, this directory does not hold a git repository',
                $this->path
            ));
        }
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function copy(string $targetDir): self
    {
        if (!$this->filesystem->exists($targetDir)) {
            $this->filesystem->mkdir($targetDir);
        }

        if ((new FilesystemIterator($targetDir))->valid()) {
            throw new RepositoryException($this, sprintf(
                'Cannot copy repository into %s, directory is not empty.',
                $targetDir
            ));
        }

        $this->filesystem->mirror($this->path, $targetDir);

        return $this->git->load($targetDir);
    }

    public function move(string $targetDir): void
    {
        if ($this->filesystem->exists($targetDir)) {
            throw new RepositoryException($this, sprintf(
                'Cannot move repository into %s, directory is not empty.',
                $targetDir
            ));
        }

        $this->filesystem->rename($this->path, $targetDir);
        $this->path = $targetDir;
    }

    public function remove(): void
    {
        $this->filesystem->exists($this->path) && $this->filesystem->remove($this->path);
    }

    public function getGit(): Git
    {
        return $this->git;
    }

    public function addOnDestroy(callable $callback): void
    {
        $this->onDestroy[] = $callback;
    }
}
