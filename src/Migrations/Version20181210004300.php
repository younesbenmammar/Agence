<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210004300 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE biens ADD surface INT NOT NULL, ADD pieces INT NOT NULL, ADD chambres INT NOT NULL, ADD etage INT NOT NULL, ADD prix INT NOT NULL, ADD chauffage INT NOT NULL, ADD ville VARCHAR(255) NOT NULL, ADD code_postale VARCHAR(255) NOT NULL, ADD disponible TINYINT(1) DEFAULT \'0\' NOT NULL, ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE biens DROP surface, DROP pieces, DROP chambres, DROP etage, DROP prix, DROP chauffage, DROP ville, DROP code_postale, DROP disponible, DROP created_at');
    }
}
