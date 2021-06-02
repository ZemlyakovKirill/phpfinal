create table educationalprogram
(
    programid  serial       not null
        constraint educationalprogram_pkey
            primary key,
    name       varchar(200) not null,
    startdate  date         not null,
    finishdate date         not null,
    cost       integer      not null
        constraint educationalprogram_cost_check
            check (cost >= 0),
    type       varchar(20)  not null,
    constraint educationalprogram_check
        check (startdate <= finishdate),
    constraint educationalprogram_check1
        check ((startdate >= '1970-01-01'::date) AND (finishdate <= '2100-01-01'::date))
);

comment on table educationalprogram is 'Создание таблицы "Образовательная Программа"
содержит
- идентификатор программы;
- наименование;
- начало обучения;
- конец обучения;
- стоимость;
- тип.
Ограничения:
-дата начала обучения меньше или равна дате окончания обучения;
-дата начала должна быть от 1970-го года и дата окончания до 2100-го года;
-стоимость должна быть положительным числом.';

alter table educationalprogram
    owner to postgres;

create table educationalgroup
(
    groupid             serial  not null
        constraint educationalgroup_pkey
            primary key,
    maxquantitystudents integer not null
        constraint educationalgroup_maxquantitystudents_check
            check (maxquantitystudents >= 0),
    studentcount        integer not null
        constraint educationalgroup_studentcount_check
            check (studentcount >= 0),
    programid           integer
        constraint "ProgramID"
            references educationalprogram
            on update cascade on delete cascade,
    constraint educationalgroup_check
        check (maxquantitystudents >= studentcount)
);

comment on table educationalgroup is 'Создание таблицы "Образовательная Группа"
содержит
- идентификатор группы;
- идентификатор программы;
- кол-во студентов в группе;
- максимальное кол-во студентов в группе.
Ограничения:
-максимальное кол-во студентов должно быть больше текущего кол-ва студентов в группе;
-максимальное кол-во студентов должно быть больше или равно 0;
-текущее кол-во студентов должно быть больше или равно 0.';

alter table educationalgroup
    owner to postgres;

create table educationalorganization
(
    organizationid serial       not null
        constraint educationalorganization_pkey
            primary key,
    name           varchar(200) not null,
    type           varchar(5)   not null,
    address        varchar(500) not null
);

comment on table educationalorganization is 'Создание таблицы "Образовательная организация"
содержит
- идентификатор организации;
- наименование;
- тип;
- адрес.';

alter table educationalorganization
    owner to postgres;

create table employee
(
    employeeid         serial      not null
        constraint employee_pkey
            primary key,
    employeelastname   varchar(50) not null,
    employeephone      varchar(13) not null,
    employeepassport   varchar(15) not null
        constraint pass_unq
            unique,
    employeefirstname  varchar(50) not null,
    employeemiddlename varchar(50)
);

comment on table employee is 'Создание таблицы "Сотрудник биржи"
содержит
- идентификатор сотрудника биржи;
- фамилия;
- номер телефона;
- пасп. данные;
- имя;
- отчество.
Ограничения:
-паспортные данные должны быть уникальными.';

alter table employee
    owner to postgres;

create table employer
(
    employerid       serial      not null
        constraint employer_pkey
            primary key,
    employerphone    varchar(15) not null,
    employerpassport varchar(15) not null
        constraint employer_pass_unq
            unique,
    employeraddress  varchar(500)
);

comment on table employer is 'Создание таблицы "Работодатель"
содержит
- идентификатор работодателя;
- номер телефона;
- паспортные данные;
- адрес.
Ограничения:
-паспортные данные должны быть уникальными.';

alter table employer
    owner to postgres;

create table job
(
    jobid             serial       not null
        constraint job_pkey
            primary key,
    employerid        integer      not null
        constraint "Employer_fkey"
            references employer,
    approximatesalary integer      not null
        constraint job_approximatesalary_check
            check (approximatesalary >= 0),
    jobname           varchar(200) not null,
    jobtype           varchar(20)  not null,
    jobaddress        varchar(500) not null
);

comment on table job is 'Создание таблицы "Вакансия"
содержит
- идентификатор вакансии;
- идентификатор работодателя;
- приблиз. зарплата;
- название вакансии;
- тип вакансии;
- адрес.
Ограничения:
-приблизительная зарплата должна быть положительной.
';

alter table job
    owner to postgres;

create table jobless
(
    joblessid         serial                not null
        constraint jobless_pkey
            primary key,
    joblessaddress    varchar(500),
    joblesslastname   varchar(50)           not null,
    joblessphone      varchar(13)           not null,
    joblesspassport   varchar(15)           not null
        constraint jobless_unq
            unique,
    workexperience    integer               not null
        constraint jobless_workexperience_check
            check (workexperience >= 0),
    organizationid    integer
        constraint "Organization_fkey"
            references educationalorganization
            on update cascade on delete set default,
    joblessfirstname  varchar(50)           not null,
    joblessmiddlename varchar(50),
    username          varchar(100)          not null,
    password          varchar(100)          not null,
    is_admin          boolean default false not null
);

comment on table jobless is 'Создание таблицы "Безработный"
содержит
- идентификатор безработного;
- адрес;
- фамилия;
- телефон;
- пасп. данные;
- стаж работы.
Ограничения:
-паспортные данные должны быть уникальными;
-стаж работы должен быть больше или равен 0.
';

alter table jobless
    owner to postgres;

create unique index jobless_username_uindex
    on jobless (username);

create table joboffer
(
    accountingid serial      not null
        constraint joboffer_pkey
            primary key,
    joblessid    integer     not null
        constraint "Jobless_fkey"
            references jobless
            on update cascade on delete cascade,
    employeeid   integer     not null
        constraint employee_fkey
            references employee,
    jobid        integer     not null
        constraint job_fkey
            references job,
    offerdate    date        not null
        constraint joboffer_offerdate_check
            check ((offerdate >= '1970-01-01'::date) AND (offerdate <= '2100-01-01'::date)),
    status       varchar(15) not null
);

comment on table joboffer is 'Создание таблицы "Предложение вакансии"
содержит
- идентификатор ведения;
- идентификатор безработного;
- идентификатор сотрудника биржи;
- идентификатор вакансии;
- дата предложения;
- статус принятия в группу.
Ограничения:
-дата предложения должна быть диапазоне от 1970-го до 2100-го года включительно.';

alter table joboffer
    owner to postgres;

create table passage
(
    passageid          serial  not null
        constraint passage_pkey
            primary key,
    joblessid          integer not null
        constraint "Jobless_fkey"
            references jobless
            on update cascade on delete cascade,
    groupid            integer not null
        constraint "Group_fkey"
            references educationalgroup,
    statusofadoption   boolean not null,
    completiondocument boolean not null
);

comment on table passage is 'Создание таблицы "Прохождение проф. подготовки/переподготовки, пов. квалификации, переквалификации"
содержит
- идентификатор прохождения;
- идентификатор безработного;
- идентификатор образовательной группы;
- Статус принятия в группу;
- Документ об окончании.';

alter table passage
    owner to postgres;

create table stipend
(
    stipendid      serial  not null
        constraint stipend_pkey
            primary key,
    joblessid      integer not null
        constraint "Jobless_fkey"
            references jobless
            on update cascade on delete cascade,
    value          integer not null
        constraint stipend_value_check
            check (value >= 0),
    provisionstart date    not null
        constraint stipend_provisionstart_check
            check ((provisionstart >= '1970-01-01'::date) AND (provisionstart <= '2100-01-01'::date)),
    provisionfin   date    not null
        constraint stipend_provisionfin_check
            check ((provisionfin >= '1970-01-01'::date) AND (provisionfin <= '2100-01-01'::date)),
    constraint stipend_check
        check (provisionstart <= provisionfin)
);

comment on table stipend is 'Создание таблицы "Пособие"
содержит
- идентификатор пособия
- идентификатор безработного;
- величина пособия;
- дату начала выплаты;
- дату окончания выплаты.
Ограничения:
-дата начала выплаты должна быть меньше даты окончания выплаты;
-дата начала выплаты должна быть от 1970-го года;
-дата окончания выплаты должна быть до 2100-го года;
-величина пособия должна быть положительной.
';

alter table stipend
    owner to postgres;

create table archive
(
    programid           integer,
    groupid             integer,
    passageid           integer,
    joblessid           integer,
    statusofadoption    boolean,
    completiondocument  boolean,
    maxquantitystudents integer,
    studentcount        integer,
    name                varchar(200),
    startdate           date,
    finishdate          date,
    cost                integer,
    type                varchar(20)
);

alter table archive
    owner to postgres;

create table auth_log
(
    username varchar(50) not null,
    date     timestamp   not null,
    address  varchar(50) not null,
    id       serial      not null
        constraint auth_log_pk
            primary key
);

alter table auth_log
    owner to postgres;

create unique index auth_log_address_uindex
    on auth_log (address);


