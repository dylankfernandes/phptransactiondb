create table hw5_user (
    id int not null auto_increment,
    email text not null,
    name text not null,
    password text not null,
    primary key (id)
);

-- Note: double hyphens are comments in SQL
create table hw5_transaction (
    id int not null auto_increment,
    user_id int not null, -- the user id who inserted this transaction
    category text not null,
    t_type text not null,
    t_date date not null, -- date is a reserved word
    amount decimal(10,2) not null, -- two decimal places
    primary key (id)
);