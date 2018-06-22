<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180622084632 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D382499D86650F');
        $this->addSql('DROP INDEX UNIQ_F2D382499D86650F ON survey_answer');
        $this->addSql('ALTER TABLE survey_answer CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D38249A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F2D38249A76ED395 ON survey_answer (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D38249A76ED395');
        $this->addSql('DROP INDEX IDX_F2D38249A76ED395 ON survey_answer');
        $this->addSql('ALTER TABLE survey_answer CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D382499D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F2D382499D86650F ON survey_answer (user_id_id)');
    }
}
