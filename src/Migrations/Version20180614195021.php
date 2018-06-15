<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180614195021 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE app_vehicle (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_cars ADD vehicle_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_cars ADD CONSTRAINT FK_90E938B4DA3FD1FC FOREIGN KEY (vehicle_type_id) REFERENCES app_vehicle (id)');
        $this->addSql('CREATE INDEX IDX_90E938B4DA3FD1FC ON app_cars (vehicle_type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_cars DROP FOREIGN KEY FK_90E938B4DA3FD1FC');
        $this->addSql('DROP TABLE app_vehicle');
        $this->addSql('DROP INDEX IDX_90E938B4DA3FD1FC ON app_cars');
        $this->addSql('ALTER TABLE app_cars DROP vehicle_type_id');
    }
}
