<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230319204516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE check_folder_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE folder_id_seq CASCADE');
        $this->addSql('ALTER TABLE check_folder DROP CONSTRAINT fk_9952f062b83297e7');
        $this->addSql('ALTER TABLE check_folder DROP CONSTRAINT fk_9952f062162cb942');
        $this->addSql('DROP TABLE check_folder');
        $this->addSql('DROP TABLE folder');
        $this->addSql('ALTER TABLE reservation ADD date_reservation DATE NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD date_mariage DATE NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD nom_epoux VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD prenom_epoux VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD nom_epouse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD prenom_epouse VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD numero_cni VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD is_active BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP nom');
        $this->addSql('ALTER TABLE reservation DROP prenom');
        $this->addSql('ALTER TABLE reservation DROP date');
        $this->addSql('ALTER TABLE reservation DROP "time"');
        $this->addSql('ALTER TABLE reservation DROP payement_status');
        $this->addSql('ALTER TABLE reservation DROP payement_date');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE check_folder_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE folder_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE check_folder (id INT NOT NULL, reservation_id INT DEFAULT NULL, folder_id INT DEFAULT NULL, file VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_9952f062162cb942 ON check_folder (folder_id)');
        $this->addSql('CREATE INDEX idx_9952f062b83297e7 ON check_folder (reservation_id)');
        $this->addSql('CREATE TABLE folder (id INT NOT NULL, nom VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE check_folder ADD CONSTRAINT fk_9952f062b83297e7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE check_folder ADD CONSTRAINT fk_9952f062162cb942 FOREIGN KEY (folder_id) REFERENCES folder (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reservation ADD nom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD "time" VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD payement_status BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD payement_date VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation DROP date_reservation');
        $this->addSql('ALTER TABLE reservation DROP date_mariage');
        $this->addSql('ALTER TABLE reservation DROP nom_epoux');
        $this->addSql('ALTER TABLE reservation DROP prenom_epoux');
        $this->addSql('ALTER TABLE reservation DROP nom_epouse');
        $this->addSql('ALTER TABLE reservation DROP prenom_epouse');
        $this->addSql('ALTER TABLE reservation DROP numero_cni');
        $this->addSql('ALTER TABLE reservation DROP is_active');
    }
}
