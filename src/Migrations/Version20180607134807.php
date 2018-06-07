<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180607134807 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_positions (id INT AUTO_INCREMENT NOT NULL, position VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_users ADD position_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C2502824DD842E46 FOREIGN KEY (position_id) REFERENCES app_positions (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C2502824DD842E46 ON app_users (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C2502824DD842E46');
        $this->addSql('DROP TABLE app_positions');
        $this->addSql('DROP INDEX UNIQ_C2502824DD842E46 ON app_users');
        $this->addSql('ALTER TABLE app_users DROP position_id');
    }
}
