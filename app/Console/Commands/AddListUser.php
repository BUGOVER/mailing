<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use MailchimpMarketing\ApiClient;

/**
 * Class AddListUser
 * @package App\Console\Commands
 */
class AddListUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add_list {list? : The name of the list}';

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
     * @return void
     */
    public function handle(): void
    {
        $mailchimp = new ApiClient();
        $mailchimp->setConfig([
            'apiKey' => env('MAILCHIMP_KEY'),
            'server' => env('MAILCHIMP_SERVER'),
        ]);

        $folder = $mailchimp->campaignFolders->list();
        $folder_id = $folder->folders[0]->id;
        $lists = $mailchimp->lists->getAllLists();
        $list_id = $lists->lists[0]->id;

        $users = User::with('mailing')->get();

        foreach ($users as $user) {
            if ($user->mailing->hash && $mailchimp->lists->getListMember($list_id, $user->mailing->hash)) {
                $this->info('Users already added');
                continue;
            }

            $response[] = $mailchimp->lists->addListMember($list_id, [
                'email_address' => $user->email,
                'status' => $user->mailing_subscribe ? 'subscribed' : 'unsubscribed',
            ]);

            $user->update(['sync_date' => now(), 'mailing_subscribe' => true]);
            $user->mailing()->updateOrCreate(['user_id' => $user->user_id], ['hash' => $response[0]->id]);
        }

        $this->info('Users added to list');
    }
}
