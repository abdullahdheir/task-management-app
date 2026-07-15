<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class DarkModeClasses extends Command
{
    protected $signature   = 'darkmode:apply {--dry-run : Preview changes without writing}';
    protected $description = 'Add dark: variant classes to all Blade files';

    // ─── Mapping: existing class → dark variant to ADD next to it ──
    private array $map = [
        // Backgrounds
        'bg-background'                => 'dark:bg-background-dark',
        'bg-surface\b'                 => 'dark:bg-surface-dark',
        'bg-surface-dim'               => 'dark:bg-surface-dim-dark',
        'bg-surface-bright'            => 'dark:bg-surface-bright-dark',
        'bg-surface-container-lowest'  => 'dark:bg-surface-container-lowest-dark',
        'bg-surface-container-low'     => 'dark:bg-surface-container-low-dark',
        'bg-surface-container-high\b'  => 'dark:bg-surface-container-high-dark',
        'bg-surface-container-highest' => 'dark:bg-surface-container-highest-dark',
        'bg-surface-container\b'       => 'dark:bg-surface-container-dark',
        'bg-surface-variant'           => 'dark:bg-surface-variant-dark',
        'bg-primary-fixed'             => 'dark:bg-primary-fixed-dark',
        'bg-primary-container'         => 'dark:bg-primary-container-dark',
        'bg-primary\b'                 => 'dark:bg-primary-dark',
        'bg-secondary-container'       => 'dark:bg-secondary-container-dark',
        'bg-secondary-fixed'           => 'dark:bg-secondary-fixed-dark',
        'bg-secondary\b'               => 'dark:bg-secondary-dark',
        'bg-tertiary-container'        => 'dark:bg-tertiary-container-dark',
        'bg-tertiary-fixed\b'          => 'dark:bg-tertiary-fixed-dark',
        'bg-tertiary\b'                => 'dark:bg-tertiary-dark',
        'bg-error-container'           => 'dark:bg-error-container-dark',
        'bg-error\b'                   => 'dark:bg-error-dark',
        'bg-white'                     => 'dark:bg-surface-container-low-dark',

        // Text
        'text-on-surface-variant'           => 'dark:text-on-surface-variant-dark',
        'text-on-surface\b'                 => 'dark:text-on-surface-dark',
        'text-on-background'                => 'dark:text-on-background-dark',
        'text-on-primary-container'         => 'dark:text-on-primary-container-dark',
        'text-on-primary-fixed'             => 'dark:text-on-primary-fixed-dark',
        'text-on-primary\b'                 => 'dark:text-on-primary-dark',
        'text-on-secondary-fixed-variant'   => 'dark:text-on-secondary-fixed-variant-dark',
        'text-on-secondary-container'       => 'dark:text-on-secondary-container-dark',
        'text-on-secondary-fixed\b'         => 'dark:text-on-secondary-fixed-dark',
        'text-on-secondary\b'               => 'dark:text-on-secondary-dark',
        'text-on-tertiary-fixed-variant'    => 'dark:text-on-tertiary-fixed-variant-dark',
        'text-on-tertiary-container'        => 'dark:text-on-tertiary-container-dark',
        'text-on-tertiary\b'                => 'dark:text-on-tertiary-dark',
        'text-on-error-container'           => 'dark:text-on-error-container-dark',
        'text-on-error\b'                   => 'dark:text-on-error-dark',
        'text-primary-fixed'                => 'dark:text-primary-fixed-dark',
        'text-primary\b'                    => 'dark:text-primary-dark',
        'text-secondary\b'                  => 'dark:text-secondary-dark',
        'text-tertiary\b'                   => 'dark:text-tertiary-dark',
        'text-error\b'                      => 'dark:text-error-dark',
        'text-outline-variant'              => 'dark:text-outline-variant-dark',
        'text-outline\b'                    => 'dark:text-outline-dark',
        'text-secondary-container'          => 'dark:text-secondary-container-dark',

        // Borders
        'border-outline-variant'   => 'dark:border-outline-variant-dark',
        'border-outline\b'         => 'dark:border-outline-dark',
        'border-primary\b'         => 'dark:border-primary-dark',
        'border-secondary\b'       => 'dark:border-secondary-dark',
        'border-error\b'           => 'dark:border-error-dark',

        // Hover backgrounds
        'hover:bg-surface-container-lowest'  => 'dark:hover:bg-surface-container-lowest-dark',
        'hover:bg-surface-container-low'     => 'dark:hover:bg-surface-container-low-dark',
        'hover:bg-surface-container-high\b'  => 'dark:hover:bg-surface-container-high-dark',
        'hover:bg-surface-container\b'       => 'dark:hover:bg-surface-container-dark',
        'hover:bg-primary-container'         => 'dark:hover:bg-primary-container-dark',
        'hover:bg-error-container'           => 'dark:hover:bg-error-container-dark',
        'hover:text-primary\b'               => 'dark:hover:text-primary-dark',
        'hover:text-on-surface\b'            => 'dark:hover:text-on-surface-dark',

        // Focus
        'focus:border-primary\b'             => 'dark:focus:border-primary-dark',
        'focus:ring-primary\b'               => 'dark:focus:ring-primary-dark',
        'focus:ring-primary-container'       => 'dark:focus:ring-primary-container-dark',

        // Divide
        'divide-outline-variant'             => 'dark:divide-outline-variant-dark',
    ];

    public function handle(): void
    {
        $dryRun    = $this->option('dry-run');
        $viewsPath = resource_path('views');
        $files     = File::allFiles($viewsPath);
        $blades    = array_filter($files, fn($f) => str_ends_with($f->getFilename(), '.blade.php'));

        $totalFiles   = 0;
        $totalChanges = 0;

        foreach ($blades as $file) {
            $original = $content = File::get($file->getPathname());
            $changes  = 0;

            foreach ($this->map as $pattern => $darkClass) {
                // Match the class inside a class="..." or :class="..." attribute
                // Only add dark variant if it doesn't already exist
                $regex = '/\b(' . $pattern . ')\b(?![^"\']*' . preg_quote($darkClass, '/') . ')/';

                $content = preg_replace_callback(
                    $regex,
                    function ($matches) use ($darkClass, &$changes) {
                        $changes++;
                        return $matches[1] . ' ' . $darkClass;
                    },
                    $content
                );
            }

            if ($content !== $original) {
                $totalFiles++;
                $totalChanges += $changes;
                $relativePath  = str_replace(base_path() . '/', '', $file->getPathname());

                if ($dryRun) {
                    $this->line("  <fg=yellow>[DRY RUN]</> {$relativePath} — {$changes} changes");
                } else {
                    File::put($file->getPathname(), $content);
                    $this->line("  <fg=green>[UPDATED]</> {$relativePath} — {$changes} changes");
                }
            }
        }

        $this->newLine();
        $this->info("✅ Done — {$totalFiles} files, {$totalChanges} classes updated" . ($dryRun ? ' (dry run)' : ''));
    }
}
