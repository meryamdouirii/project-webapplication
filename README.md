## The festival haarlem

### Inloggegevens
- **Wachtwoord voor alle gebruikers:** `password123!`
- Administrator: groenromy0@gmail.com
- Employee: 701224@student.inholland.nl
- Customer: douirimeryam14@gmail.com

## Instructies voor het starten van de applicatie
1. Open de terminal.
2. Voer het volgende commando in:
   "docker-compose build"
3. Daarna voer je in:
   "docker compose up"
4. Check of er een vendor map is aangemaakt, zo niet, voer de volgende commands in:
   4.1 : docker-compose exec php bash
   4.2 : cd /app
   4.3 : composer install --no-dev --optimize-autoloader
5. Open een browser en navigeer naar:
   http://localhost
6. Log in met de verstrekte inloggegevens.
als dit niet lukt moet je eerst dit doen: 
7. run "docker exec -it project-webapplication-php-1 bash"
   7.1 Als je errors ziet zoals failed to download run "apt-get update && apt-get install -y unzip git"
7. run "composer install"


