<?php

namespace App\DataFixtures;

use App\Entity\Education;
use App\Entity\Resume;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Expression;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $education_1 = new Education();
        $education_1->setType('Высшее');
        $education_1->setInstitution('ЛГГУ');
        $education_1->setFaculty('ФФИИ');
        $education_1->setSpecialization('Нейролог');
        $education_1->setEnding('2001');

        $manager->persist($education_1);



        $resume_1 = new Resume();
        $resume_1->setProfession('Врач');
        $resume_1->setCity('Грязи');
        $resume_1->setPhoto('https://sun1-93.userapi.com/impg/vE7YNqUukCPiEyK2KUe3KtsWTD91GdpTcnp5MQ/0q08r0HNmqY.jpg?size=700x479&quality=96&sign=be2663508b761e6e8db79fe85adee6bc&type=album');
        $resume_1->setSurname('Вавилов');
        $resume_1->setName('Петр');
        $resume_1->setPatronymic('Иванович');
        $resume_1->setPhone('88005553535');
        $resume_1->setMail('grazy@mail.ru');
        $resume_1->setBDate('2000-10-10');
        $resume_1->setMoney('99990');
        $resume_1->setSkills('Шитье');
        $resume_1->setAbout('Большой стаж работы');
        $resume_1->setStatus('Новый');
        $resume_1->addEducation($education_1);

        $manager->persist($resume_1);



        $education_2 = new Education();
        $education_2->setType('Среднее');
        $manager->persist($education_2);



        $resume_2 = new Resume();
        $resume_2->setProfession('Бизнес мен');
        $resume_2->setCity('Саратов');
        $resume_2->setPhoto('https://cdn.mos.cms.futurecdn.net/9R9gFnB9giZpgTVdzbvs9B-1920-80.jpg');
        $resume_2->setSurname('Умничев');
        $resume_2->setName('Умница');
        $resume_2->setPatronymic('Умнович');
        $resume_2->setPhone('88105553535');
        $resume_2->setMail('grazi@mail.ru');
        $resume_2->setBDate('2000-10-5');
        $resume_2->setMoney('999990');
        $resume_2->setSkills('все-все');
        $resume_2->setAbout('Лучше меня нет');
        $resume_2->setStatus('Отказ');
        $resume_2->addEducation($education_2);

        $manager->persist($resume_2);



        $education_3 = new Education();
        $education_3->setType('Высшее');
        $education_3->setInstitution('ЛГГУ2');
        $education_3->setFaculty('ФФAИИ');
        $education_3->setSpecialization('Водитель Тарелок');
        $education_3->setEnding('2007');

        $manager->persist($education_3);



        $resume_3 = new Resume();
        $resume_3->setProfession('Пилот');
        $resume_3->setCity('Москва');
        $resume_3->setPhoto('https://sun9-9.userapi.com/impg/VfSKjgVfMte9TZnRquPzABoHo5NAMvyW0mlylg/8yaIUgDY3Lk.jpg?size=494x386&quality=96&sign=6d3ef574b70ad108f9fc4c3bb92f5666&type=album');
        $resume_3->setSurname('Летаев');
        $resume_3->setName('Денис');
        $resume_3->setPatronymic('Анатольевич');
        $resume_3->setPhone('88005553535');
        $resume_3->setMail('grazy2@mail.ru');
        $resume_3->setBDate('1979-10-10');
        $resume_3->setMoney('400000');
        $resume_3->setSkills('Езда вслепую');
        $resume_3->setAbout('Знаю как изготавливать алтернативное топливо');
        $resume_3->setStatus('Принят');
        $resume_3->addEducation($education_3);

        $manager->persist($resume_3);


        $manager->flush();
    }
}
