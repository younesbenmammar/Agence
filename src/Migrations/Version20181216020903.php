<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181216020903 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE biens ADD filename VARCHAR(255) NOT NULL, CHANGE disponible disponible TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE biens_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE biens_option ADD PRIMARY KEY (biens_id, option_id)');
        $this->addSql('ALTER TABLE biens_option RENAME INDEX idx_267bb9b57773350c TO IDX_2B4CA7797773350C');
        $this->addSql('ALTER TABLE biens_option RENAME INDEX idx_267bb9b5a7c41d6f TO IDX_2B4CA779A7C41D6F');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE biens DROP filename, CHANGE disponible disponible TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE biens_option DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE biens_option ADD PRIMARY KEY (option_id, biens_id)');
        $this->addSql('ALTER TABLE biens_option RENAME INDEX idx_2b4ca779a7c41d6f TO IDX_267BB9B5A7C41D6F');
        $this->addSql('ALTER TABLE biens_option RENAME INDEX idx_2b4ca7797773350c TO IDX_267BB9B57773350C');
    }
}
