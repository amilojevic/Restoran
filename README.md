# Restoran
Restoran za WT. Mogucnost pregleda meni-a, rezervacije i drugo. Andrej Milojevic. Broj Indexa: 16092

 * Uradeni mockups-i pomocu stranice (uradeni za 2 tipa ekrana, veci od 750px i manji). U folderu MockUps se moku naci slike
 * U folderu Restoran su html filo-vi, css file, js file kao i slike koje sam koristio
 * Responzivni grid uraden sa postocima. Isto je tako uraden responsiv za male uredaje pomocu media query
 * Meni je u wide ekranima u horiyontalnoj formi, a u malim je kao verticalni menu
 * Implementirane su par formi. U registraciji, login, rezrvaciji, kontakt kao i pri prelasku na druge stranice kod registracije
 * Na dva monitora mi se prikazuje razlicita boja pozadine(iako je isti hex code). Na laptopu je smedi a na monitoru zuckasti
 * kada se smanji ekran malo se text buttona prede preko bordera, i input type date nije podrzan na svakom browser-u

# Spirala 2

* Uraden Ajax, galerija, auto-carousel(ne znam da li se ovo broji pod carousel) i validacija formi (nije uradena samo jedna validacije forme a to je zbog toga sto je u toj formi samo button)
* Ajax loadnje radi na Firefoxu bez dizanje servera dok na onstalim browserima treba dici server
* Ima mali bug gdje se u formi kada nastupi greska pomjeri input linija u novi red
* Ovaj update na folderu restoran je samo zbog toga sto sam obrisao jedan nevazan file(ostao tokom commita), svi ostali filovi (filovi vezabi za zadacu) su commitani 2 sata prije roka

# Spirala 3

* Uraden login sa podacima iz xml file (user admin pass admin)
* Kada se user prijavi dobije dva button-a za logout i da ode na admin page
* Na admin page-u je uraden search (php sa ajaxom), ispis podataka iz xml, edit podataka, kao i export podataka u csv i pdf file
* Pritiskom na enter tipku se vrsi search gdje ce se pojaviti svi moguci elemnti koji se slazu po imenu ili prezimenu
* Na stranici Reservations.php se ubacuju podaci u xml file

# Spirala 4

* Napravljena je baza sa usernameom andrej i passwordom admin
* U bazi su 3 tabele, User, Rezervacije i kontakt. Tabele su povezane sa id kljucem usera (gdje je ako nije logovan user a napravi rezervaciju ili ostavi komentar id 99)
* Importuje se 2 xml dokumenta sa admin page-a. A to su users.xml i reservations.xml
* Napravljeno je da sql radi sa formama umjeto sa xml-om
* Rest metoda je u posebnom php-u koji se zove restPart
* restPart.php vraca sve reservacije reervacija sa odredenim id-om i reservacija sa imenom