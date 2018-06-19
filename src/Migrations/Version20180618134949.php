<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180618134949 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE survey_poll (id INT AUTO_INCREMENT NOT NULL, date_begin DATETIME DEFAULT NULL, date_end DATETIME DEFAULT NULL, question VARCHAR(255) DEFAULT NULL, limit_user INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE poll ADD survey_poll_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll ADD CONSTRAINT FK_84BCFA4578B85FB4 FOREIGN KEY (survey_poll_id) REFERENCES survey_poll (id)');
        $this->addSql('CREATE INDEX IDX_84BCFA4578B85FB4 ON poll (survey_poll_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll DROP FOREIGN KEY FK_84BCFA4578B85FB4');
        $this->addSql('DROP TABLE survey_poll');
        $this->addSql('DROP INDEX IDX_84BCFA4578B85FB4 ON poll');
        $this->addSql('ALTER TABLE poll DROP survey_poll_id');
    }
}
