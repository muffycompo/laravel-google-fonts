<?php

namespace Spatie\GoogleFonts\Commands;

use Illuminate\Console\Command;
use Spatie\GoogleFonts\GoogleFonts;

class FetchGoogleFontsCommand extends Command
{
    public $signature = 'google-fonts:fetch';

    public $description = 'Fetch Google Fonts and store them on a local disk';

    public function handle()
    {
        $this->info('Start fetching Google Fonts...');

        collect(config('google-fonts.fonts'))
            ->keys()
            ->each(function (string $font) {
                $forceDownload = true;

                $this->info("Fetching `{$font}`...");

                app(GoogleFonts::class)->load($font, $forceDownload);
            });

        $this->info('All done!');
    }
}
