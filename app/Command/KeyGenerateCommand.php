<?php

namespace App\Command;


use http\Exception\BadMessageException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class KeyGenerateCommand extends Command
{
    protected static $defaultName = 'key:generate';
    protected static $defaultDescription = 'Set the application key';


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('生成 Key 开始');
        $key = $this->generateRandomKey();
        file_put_contents(base_path() . "/.env", str_replace(
            "APP_KEY=",
            "APP_KEY=" . $key,
            file_get_contents(base_path() . "/.env")
        ));
        $output->writeln('生成 Key 结束' . $key);
        return self::SUCCESS;
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function generateRandomKey()
    {
        try {
            return 'base64:' . base64_encode(random_bytes(32));
        } catch (\Exception $e) {
            throw new BadMessageException($e->getMessage());
        }
    }
}
