<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619171639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alumnos (id INT AUTO_INCREMENT NOT NULL, escuela INT DEFAULT NULL, categoria INT NOT NULL, cedula VARCHAR(10) NOT NULL, nombres VARCHAR(50) NOT NULL, apellidos VARCHAR(50) NOT NULL, genero VARCHAR(20) NOT NULL, estatura DOUBLE PRECISION NOT NULL, peso DOUBLE PRECISION NOT NULL, edad INT NOT NULL, INDEX IDX_5EC5A6ABF6C6E2CE (escuela), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_escuela (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categoria_estudiante (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE escuelas (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(100) DEFAULT NULL, direccion VARCHAR(100) DEFAULT NULL, categoria INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jugadores_destacados (id INT AUTO_INCREMENT NOT NULL, categoria INT NOT NULL, nombres VARCHAR(100) NOT NULL, apellidos VARCHAR(100) NOT NULL, genero VARCHAR(100) NOT NULL, edad INT NOT NULL, estatura DOUBLE PRECISION NOT NULL, peso DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jugadores_titulos (id INT AUTO_INCREMENT NOT NULL, jugador INT NOT NULL, titulo VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE registro_entrenamiento (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, escuela INT DEFAULT NULL, alumno INT DEFAULT NULL, rutina BIGINT DEFAULT NULL, fecha DATE DEFAULT NULL, INDEX IDX_9B6C499BF6C6E2CE (escuela), INDEX IDX_9B6C499B1435D52D (alumno), INDEX IDX_9B6C499BA48AB255 (rutina), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(35) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rutina_deportivas (id BIGINT AUTO_INCREMENT NOT NULL, jugador BIGINT DEFAULT NULL, dia VARCHAR(50) DEFAULT NULL, nombre VARCHAR(50) DEFAULT NULL, repeticiones VARCHAR(50) DEFAULT NULL, INDEX IDX_28012078527D6F18 (jugador), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, escuela INT NOT NULL, usuario VARCHAR(10) NOT NULL, clave VARCHAR(10) NOT NULL, nombres VARCHAR(50) NOT NULL, rol INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alumnos ADD CONSTRAINT FK_5EC5A6ABF6C6E2CE FOREIGN KEY (escuela) REFERENCES escuelas (id)');
        $this->addSql('ALTER TABLE registro_entrenamiento ADD CONSTRAINT FK_9B6C499BF6C6E2CE FOREIGN KEY (escuela) REFERENCES escuelas (id)');
        $this->addSql('ALTER TABLE registro_entrenamiento ADD CONSTRAINT FK_9B6C499B1435D52D FOREIGN KEY (alumno) REFERENCES alumnos (id)');
        $this->addSql('ALTER TABLE registro_entrenamiento ADD CONSTRAINT FK_9B6C499BA48AB255 FOREIGN KEY (rutina) REFERENCES rutina_deportivas (id)');
        $this->addSql('ALTER TABLE rutina_deportivas ADD CONSTRAINT FK_28012078527D6F18 FOREIGN KEY (jugador) REFERENCES jugadores_destacados (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alumnos DROP FOREIGN KEY FK_5EC5A6ABF6C6E2CE');
        $this->addSql('ALTER TABLE registro_entrenamiento DROP FOREIGN KEY FK_9B6C499BF6C6E2CE');
        $this->addSql('ALTER TABLE registro_entrenamiento DROP FOREIGN KEY FK_9B6C499B1435D52D');
        $this->addSql('ALTER TABLE registro_entrenamiento DROP FOREIGN KEY FK_9B6C499BA48AB255');
        $this->addSql('ALTER TABLE rutina_deportivas DROP FOREIGN KEY FK_28012078527D6F18');
        $this->addSql('DROP TABLE alumnos');
        $this->addSql('DROP TABLE categoria_escuela');
        $this->addSql('DROP TABLE categoria_estudiante');
        $this->addSql('DROP TABLE escuelas');
        $this->addSql('DROP TABLE jugadores_destacados');
        $this->addSql('DROP TABLE jugadores_titulos');
        $this->addSql('DROP TABLE registro_entrenamiento');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE rutina_deportivas');
        $this->addSql('DROP TABLE usuarios');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
