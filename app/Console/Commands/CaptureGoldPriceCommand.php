<?php

namespace App\Console\Commands;

use App\Mail\GoldPriceMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Spatie\Browsershot\Browsershot;

class CaptureGoldPriceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gold-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Capture gold price from the internet and store it in the storage';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Browsershot::url('https://www.24h.com.vn/gia-vang-hom-nay-c425.html')
            ->setChromePath('/home/quanph/gia-vang/chrome/linux-127.0.6533.99/chrome-linux64/chrome')
            ->windowSize(1100, 720)
            ->deviceScaleFactor(2)
            ->save(public_path('gold-price.png'));

        $this->info('Gold price has been captured and stored in the storage');
        
        // Send an email to the admin
        Mail::to('code.tieumomo@gmail.com')->send(new GoldPriceMail());
    }
}
