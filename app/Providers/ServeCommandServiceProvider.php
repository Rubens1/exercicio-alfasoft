<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\ServeCommand;
use Carbon\Carbon;

class ServeCommandServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->extend(ServeCommand::class, function ($command, $app) {
            return new class extends ServeCommand {
                protected function getDateFromLine($line)
                {
                    $regex = env('PHP_CLI_SERVER_WORKERS', 1) > 1
                        ? '/^\[\d+]\s\[([a-zA-Z0-9: ]+)\]/'
                        : '/^\[([^\]]+)\]/';

                    $line = str_replace('  ', ' ', $line);

                    if (preg_match($regex, $line, $matches)) {
                        try {
                            return Carbon::createFromFormat('D M d H:i:s Y', $matches[1]);
                        } catch (\Exception $e) {
                            return Carbon::now();
                        }
                    }

                    return Carbon::now();
                }
            };
        });
    }
} 