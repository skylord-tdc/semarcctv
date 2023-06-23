#Account.
username : admin@semarcctv.test
password : root-0
---------------------------------
##Mandatory Step##
------------------
#How to turn on EVENT-SCHEDULER via phpmyadmin SQL.
=> SET GLOBAL event_scheduler = ON;

#To check whether the event scheduler is running or not, you can use the command.
=> SHOW PROCESSLIST atau SHOW EVENTS

#How to delete events.
=> DROP EVENT IF EXISTS name_database.name_event;

#Create a delete event for orders that are more than 2 minutes old with a blank receipt.
=>
CREATE EVENT hapus_pesanan
ON SCHEDULE EVERY 4 MINUTE
DO
  DELETE FROM pesanan
  WHERE waktu < DATE_ADD(NOW(), INTERVAL -5 MINUTE) AND bukti_pembayaran IS NULL; 