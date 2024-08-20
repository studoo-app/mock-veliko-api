create table station_status
(
    station_id                integer not null
        constraint station_status_pk
            unique,
    num_bikes_available       INT,
    num_bikes_available_types BLOB,
    num_docks_available       INT,
    is_installed              INT,
    is_returning              INT,
    is_renting                INT,
    last_reported             INT
);