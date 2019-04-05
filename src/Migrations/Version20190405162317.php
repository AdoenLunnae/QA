<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405162317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE question ADD best_answer_id INT DEFAULT NULL, ADD is_resolved TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494EB6DEA817 FOREIGN KEY (best_answer_id) REFERENCES answer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B6F7494EB6DEA817 ON question (best_answer_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25D3EAB6BC');
        $this->addSql('DROP INDEX IDX_DADD4A25D3EAB6BC ON answer');
        $this->addSql('ALTER TABLE answer ADD is_resolved TINYINT(1) NOT NULL, CHANGE created_by_id createb_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25D3EAB6BC FOREIGN KEY (createb_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25D3EAB6BC ON answer (createb_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A25D3EAB6BC');
        $this->addSql('DROP INDEX IDX_DADD4A25D3EAB6BC ON answer');
        $this->addSql('ALTER TABLE answer DROP is_resolved, CHANGE createb_by_id created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A25D3EAB6BC FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DADD4A25D3EAB6BC ON answer (created_by_id)');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EB6DEA817');
        $this->addSql('DROP INDEX UNIQ_B6F7494EB6DEA817 ON question');
        $this->addSql('ALTER TABLE question DROP best_answer_id, DROP is_resolved');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
