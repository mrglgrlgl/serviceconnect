<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\text;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Log;

class SendMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a message to the chat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = text(
            label: "What is your name?",
            required: true
        );

        $text = text(
            label: "What is your message?",
            required: true
        );

        Log::info('Dispatching MessageSent event', ['name' => $name, 'text' => $text]);

        MessageSent::dispatch($name, $text);

        // Just to confirm it reaches here
        $this->info('MessageSent event dispatched.');    }
}
