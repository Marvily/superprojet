<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210327175327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE connect_student (student_id INT NOT NULL, masterclass_id INT NOT NULL, debutconnexion TIME NOT NULL, finconnexion TIME NOT NULL, INDEX IDX_7BFAF8AD426F0705 (masterclass_id), PRIMARY KEY(student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE connect_student ADD CONSTRAINT FK_7BFAF8ADCB944F1A FOREIGN KEY (student_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE connect_student ADD CONSTRAINT FK_7BFAF8AD426F0705 FOREIGN KEY (masterclass_id) REFERENCES masterclass (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE connect_student');
    }
}
