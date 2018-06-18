<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180615092033 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_customers ADD car_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_customers ADD CONSTRAINT FK_CA3C1114C3C6F69F FOREIGN KEY (car_id) REFERENCES app_cars (id)');
        $this->addSql('CREATE INDEX IDX_CA3C1114C3C6F69F ON app_customers (car_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_customers DROP FOREIGN KEY FK_CA3C1114C3C6F69F');
        $this->addSql('DROP INDEX IDX_CA3C1114C3C6F69F ON app_customers');
        $this->addSql('ALTER TABLE app_customers DROP car_id');
    }
}
