<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180615092546 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_cars ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_cars ADD CONSTRAINT FK_90E938B49395C3F3 FOREIGN KEY (customer_id) REFERENCES app_customers (id)');
        $this->addSql('CREATE INDEX IDX_90E938B49395C3F3 ON app_cars (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE app_cars DROP FOREIGN KEY FK_90E938B49395C3F3');
        $this->addSql('DROP INDEX IDX_90E938B49395C3F3 ON app_cars');
        $this->addSql('ALTER TABLE app_cars DROP customer_id');
    }
}
