<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use MailchimpMarketing\ApiClient;

/**
 * Class UpdateStatusUser
 * @package App\Console\Commands
 */
class UpdateStatusUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update_status {user_id? : id od user in db}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $mailchimp = new ApiClient();
        $mailchimp->setConfig([
            'apiKey' => env('MAILCHIMP_KEY'),
            'server' => env('MAILCHIMP_SERVER'),
        ]);
        $lists = $mailchimp->lists->getAllLists();
        $list_id = $lists->lists[0]->id;

        $args = $this->argument('user_id');
        $users = $args
            ? User::with('mailing')->find($this->argument('user_id'))
            : User::with('mailing')->get();

        if ($args) {
            if ($users->mailing->hash) {
                $has_list = $mailchimp->lists->getListMember($list_id, $users->mailing->hash);
                $users->update(['mailing_subscribe' => 'unsubscribed' !== $has_list->status]);
            }
        } else {
            foreach ($users as $user) {
                if ($user->mailing->hash) {
                    $has_list = $mailchimp->lists->getListMember($list_id, $user->mailing->hash);
                    $user->update(['mailing_subscribe' => 'unsubscribed' !== $has_list->status]);
                }
            }
        }

        $this->info('Updated data');
        return 0;
    }
}
