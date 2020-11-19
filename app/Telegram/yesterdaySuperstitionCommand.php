<?php

namespace App\Telegram;

use App\Models\Sign;
use Telegram\Bot\Actions;
use Telegram\Bot\Commands\Command;

/**
 * Class HelpCommand.
 */
class yesterdaySuperstitionCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'yesterday';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['yesterday_command'];

    /**
     * @var string Command Description
     */
    protected $description = 'Примета на сегодня';

    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $day = date('d');
        $month = date('m');

        $sign = Sign::where([
            ['day', '=', $day - 1],
            ['month', '=', $month],
        ])->get()->toArray();

        if (isset($sign[0]))
            $text = $sign[0]['name'] . PHP_EOL . $sign[0]['description'];
        else
            $text = __('Долгие наблюдения за природй не дали резултатов.'. PHP_EOL . 'Примет на сегодня нет');

        $this->replyWithMessage(compact('text'));
    }
}
