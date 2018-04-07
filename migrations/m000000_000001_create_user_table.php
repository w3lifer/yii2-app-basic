<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m000000_000001_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute(<<<'SQL'

CREATE TABLE IF NOT EXISTS `user`
(
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `password_reset_token` VARCHAR(255),
  `status` TINYINT(2) DEFAULT 1,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE UNIQUE INDEX `username` ON `user` (`username`);

CREATE UNIQUE INDEX `email` ON `user` (`email`);

CREATE UNIQUE INDEX `password_reset_token` ON `user` (`password_reset_token`);
              
SQL
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
