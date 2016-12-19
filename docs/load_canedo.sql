\c canedo

\copy users FROM 'C:/Users/abbey/Desktop/mp/csv/users.csv' with delimiter as ',' csv;
\copy profiles FROM 'C:/Users/abbey/Desktop/mp/csv/profiles.csv' with delimiter as ',' csv;
\copy products FROM 'C:/Users/abbey/Desktop/mp/csv/products.csv' with delimiter as ',' csv;
\copy carts FROM 'C:/Users/abbey/Desktop/mp/csv/carts.csv' with delimiter as ',' csv;
\copy transactions FROM 'C:/Users/abbey/Desktop/mp/csv/transactions.csv' with delimiter as ',' csv;