<?php

namespace App\Console;

use Illuminate\Console\Command;

class SteamGoodsPrice extends Command
{

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'steamGoodsPrice';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '价格监控';


	/**
	 *
	 * @return string
	 */
	public function handle()
	{

		while (true) {

			echo '1';

			sleep(1);

		}
	}



}
