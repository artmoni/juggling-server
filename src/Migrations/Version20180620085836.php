<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180620085836 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D38249AA334807');
        $this->addSql('DROP INDEX FK_F2D38249AA334807 ON survey_answer');
        $this->addSql('ALTER TABLE survey_answer CHANGE answer_id answer_id INT NOT NULL');
        $this->addSql('ALTER TABLE poll_answer ADD scene_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE poll_answer ADD CONSTRAINT FK_36D8097E166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id)');
        $this->addSql('CREATE INDEX IDX_36D8097E166053B4 ON poll_answer (scene_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE poll_answer DROP FOREIGN KEY FK_36D8097E166053B4');
        $this->addSql('DROP INDEX IDX_36D8097E166053B4 ON poll_answer');
        $this->addSql('ALTER TABLE poll_answer DROP scene_id');
        $this->addSql('ALTER TABLE survey_answer CHANGE answer_id answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D38249AA334807 FOREIGN KEY (answer_id) REFERENCES poll_answer (id)');
        $this->addSql('CREATE INDEX FK_F2D38249AA334807 ON survey_answer (answer_id)');
    }
}
