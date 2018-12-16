<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181215234341 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_biens (option_id INT NOT NULL, biens_id INT NOT NULL, INDEX IDX_267BB9B5A7C41D6F (option_id), INDEX IDX_267BB9B57773350C (biens_id), PRIMARY KEY(option_id, biens_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biens_option ADD CONSTRAINT FK_267BB9B5A7C41D6F FOREIGN KEY (option_id) REFERENCES `option` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE biens_option ADD CONSTRAINT FK_267BB9B57773350C FOREIGN KEY (biens_id) REFERENCES biens (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE biens CHANGE disponible disponible TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE created_at created_at DATETIME is NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE biens_option DROP FOREIGN KEY FK_267BB9B5A7C41D6F');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE biens_option');
        $this->addSql('ALTER TABLE biens CHANGE disponible disponible TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
    }
}
