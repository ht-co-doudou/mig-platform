<?php

use Doudou\EnumPlatform\Manager\Status;
use Doudou\EnumPlatform\Manager\Type;
use Phinx\Seed\AbstractSeed;
use Ramsey\Uuid\Uuid;

class RequiredManagerSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            'uid' => Uuid::uuid4()->getHex(),
            'username' => 'root',
            'password' => password_hash('Q5F4yF@jqszTU479', PASSWORD_BCRYPT),
            'nickname' => '系統管理員',
            'metadata' => '{}',
            'type' => Type::ROOT,
            'status' => Status::ACTIVE,
        ];

        $this->table('managers')->insert($data)->save();
    }
}
