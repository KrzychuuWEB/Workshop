<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180608114816 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_permission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_position (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_users (id INT AUTO_INCREMENT NOT NULL, position_id INT NOT NULL, permission_id INT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(254) NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_C2502824F85E0677 (username), UNIQUE INDEX UNIQ_C2502824E7927C74 (email), INDEX IDX_C2502824DD842E46 (position_id), INDEX IDX_C2502824FED90CCA (permission_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C2502824DD842E46 FOREIGN KEY (position_id) REFERENCES app_position (id)');
        $this->addSql('ALTER TABLE app_users ADD CONSTRAINT FK_C2502824FED90CCA FOREIGN KEY (permission_id) REFERENCES app_permission (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C2502824FED90CCA');
        $this->addSql('ALTER TABLE app_users DROP FOREIGN KEY FK_C2502824DD842E46');
        $this->addSql('DROP TABLE app_permission');
        $this->addSql('DROP TABLE app_position');
        $this->addSql('DROP TABLE app_users');
    }
}
