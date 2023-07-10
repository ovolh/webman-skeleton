<?php

namespace app\command;


use app\exception\BadRequestException;
use Shopwwi\WebmanAuth\Facade\Str;
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
        $output->writeln('生成 App Key 开始');
        $key = $this->generateRandomKey();
        file_put_contents(base_path() . "/.env", str_replace(
            "APP_KEY=",
            "APP_KEY=" . $key,
            file_get_contents(base_path() . "/.env")
        ));
        $output->writeln('生成 App Key 结束' . $key);

        $output->writeln('生成 jwtKey 开始');
        $key = Str::random(64);
        $refresh_key = Str::random(64);
        file_put_contents(base_path() . "/.env", str_replace(
            "JWT_ACCESS_SECRET_KEY=",
            "JWT_ACCESS_SECRET_KEY=" . $key,
            file_get_contents(base_path() . "/.env")
        ));
        file_put_contents(base_path() . "/.env", str_replace(
            "JWT_REFRESH_SECRET_KEY=",
            "JWT_REFRESH_SECRET_KEY=" . $refresh_key,
            file_get_contents(base_path() . "/.env")
        ));
        $output->writeln('生成 jwtKey 结束, access_secret_key=' . $key);
        $output->writeln('生成 jwtKey 结束, refresh_secret_key=' . $key);

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
            throw new BadRequestException($e->getMessage());
        }
    }
}
