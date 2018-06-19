<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180619133448 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D382495C8FE9A1');
        $this->addSql('DROP INDEX IDX_F2D382495C8FE9A1 ON survey_answer');
        $this->addSql('ALTER TABLE survey_answer CHANGE survey_poll_id_id survey_poll_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D3824978B85FB4 FOREIGN KEY (survey_poll_id) REFERENCES survey_poll (id)');
        $this->addSql('CREATE INDEX IDX_F2D3824978B85FB4 ON survey_answer (survey_poll_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D3824978B85FB4');
        $this->addSql('DROP INDEX IDX_F2D3824978B85FB4 ON survey_answer');
        $this->addSql('ALTER TABLE survey_answer CHANGE survey_poll_id survey_poll_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D382495C8FE9A1 FOREIGN KEY (survey_poll_id_id) REFERENCES survey_poll (id)');
        $this->addSql('CREATE INDEX IDX_F2D382495C8FE9A1 ON survey_answer (survey_poll_id_id)');
    }
}
