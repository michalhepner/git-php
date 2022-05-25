<?php
declare(strict_types=1);

namespace MichalHepner\Git\Command;

class DiffCommand extends AbstractCommand
{
    public const ARGUMENT_SPEC = 'spec';
    public const OPTION_Z = '-z';
    public const OPTION_L = '-l';
    public const OPTION_S = '-S';
    public const OPTION_G = '-G';
    public const OPTION_O = '-O';
    public const OPTION_R = '-R';
    public const OPTION_0 = '-0';
    public const OPTION_PATCH = '--patch';
    public const OPTION_NO_PATCH = '--no-patch';
    public const OPTION_UNIFIED = '--unified';
    public const OPTION_OUTPUT = '--output';
    public const OPTION_OUTPUT_INDICATOR_NEW = '--output-indicator-new';
    public const OPTION_OUTPUT_INDICATOR_OLD = '--output-indicator-old';
    public const OPTION_OUTPUT_INDICATOR_CONTEXT = '--output-indicator-context';
    public const OPTION_RAW = '--raw';
    public const OPTION_PATCH_WITH_RAW = '--patch-with-raw';
    public const OPTION_INDENT_HEURISTIC = '--indent-heuristic';
    public const OPTION_NO_INDENT_HEURISTIC = '--no-indent-heuristic';
    public const OPTION_MINIMAL = '--minimal';
    public const OPTION_PATIENCE = '--patience';
    public const OPTION_HISTOGRAM = '--histogram';
    public const OPTION_ANCHORED = '--anchored';
    public const OPTION_DIFF_ALGORITHM = '--diff-algorithm';
    public const OPTION_STAT = '--stat';
    public const OPTION_STAT_WIDTH = '--stat-width';
    public const OPTION_STAT_NAME_WIDTH = '--stat-name-width';
    public const OPTION_STAT_COUNT = '--stat-count';
    public const OPTION_COMPACT_SUMMARY = '--compact-summary';
    public const OPTION_NUMSTAT = '--numstat';
    public const OPTION_SHORTSTAT = '--shortstat';
    public const OPTION_DIRSTAT = '--dirstat';
    public const OPTION_CUMULATIVE = '--cumulative';
    public const OPTION_DIRSTAT_BY_FILE = '--dirstat-by-file';
    public const OPTION_SUMMARY = '--summary';
    public const OPTION_PATCH_WITH_STAT = '--patch-with-stat';
    public const OPTION_NAME_ONLY = '--name-only';
    public const OPTION_NAME_STATUS = '--name-status';
    public const OPTION_SUBMODULE = '--submodule';
    public const OPTION_COLOR = '--color';
    public const OPTION_NO_COLOR = '--no-color';
    public const OPTION_COLOR_MOVED = '--color-moved';
    public const OPTION_NO_COLOR_MOVED = '--no-color-moved';
    public const OPTION_COLOR_MOVED_WS = '--color-moved-ws';
    public const OPTION_NO_COLOR_MOVED_WS = '--no-color-moved-ws';
    public const OPTION_WORD_DIFF = '--word-diff';
    public const OPTION_WORD_DIFF_REGEX = '--word-diff-regex';
    public const OPTION_COLOR_WORDS = '--color-words';
    public const OPTION_NO_RENAMES = '--no-renames';
    public const OPTION_RENAME_EMPTY = '--rename-empty';
    public const OPTION_NO_RENAME_EMPTY = '--no-rename-empty';
    public const OPTION_CHECK = '--check';
    public const OPTION_WS_ERROR_HIGHLIGHT = '--ws-error-highlight';
    public const OPTION_FULL_INDEX = '--full-index';
    public const OPTION_BINARY = '--binary';
    public const OPTION_ABBREV = '--abbrev';
    public const OPTION_BREAK_REWRITES = '--break-rewrites';
    public const OPTION_FIND_RENAMES = '--find-renames';
    public const OPTION_FIND_COPIES = '--find-copies';
    public const OPTION_FIND_COPIES_HARDER = '--find-copies-harder';
    public const OPTION_IRREVERSIBLE_DELETE = '--irreversible-delete';
    public const OPTION_DIFF_FILTER = '--diff-filter';
    public const OPTION_FIND_OBJECT = '--find-object';
    public const OPTION_PICKAXE_ALL = '--pickaxe-all';
    public const OPTION_PICKAXE_REGEX = '--pickaxe-regex';
    public const OPTION_SKIP_TO = '--skip-to';
    public const OPTION_ROTATE_TO = '--rotate-to';
    public const OPTION_RELATIVE = '--relative';
    public const OPTION_NO_RELATIVE = '--no-relative';
    public const OPTION_TEXT = '--text';
    public const OPTION_IGNORE_CR_AT_EOL = '--ignore-cr-at-eol';
    public const OPTION_IGNORE_SPACE_AT_EOL = '--ignore-space-at-eol';
    public const OPTION_IGNORE_SPACE_CHANGE = '--ignore-space-change';
    public const OPTION_IGNORE_ALL_SPACE = '--ignore-all-space';
    public const OPTION_IGNORE_BLANK_LINES = '--ignore-blank-lines';
    public const OPTION_IGNORE_MATCHING_LINES = '--ignore-matching-lines';
    public const OPTION_INTER_HUNK_CONTEXT = '--inter-hunk-context';
    public const OPTION_FUNCTION_CONTEXT = '--function-context';
    public const OPTION_EXIT_CODE = '--exit-code';
    public const OPTION_QUIET = '--quiet';
    public const OPTION_EXT_DIFF = '--ext-diff';
    public const OPTION_NO_EXT_DIFF = '--no-ext-diff';
    public const OPTION_TEXTCONV = '--textconv';
    public const OPTION_NO_TEXTCONV = '--no-textconv';
    public const OPTION_IGNORE_SUBMODULES = '--ignore-submodules';
    public const OPTION_SRC_PREFIX = '--src-prefix';
    public const OPTION_DST_PREFIX = '--dst-prefix';
    public const OPTION_NO_PREFIX = '--no-prefix';
    public const OPTION_LINE_PREFIX = '--line-prefix';
    public const OPTION_ITA_INVISIBLE_IN_INDEX = '--ita-invisible-in-index';
    public const OPTION_BASE = '--base';
    public const OPTION_OURS = '--ours';
    public const OPTION_THEIRS = '--theirs';

    public function getName(): string
    {
        return 'diff';
    }
}
