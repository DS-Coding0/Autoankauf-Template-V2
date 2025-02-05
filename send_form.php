<?php
// Empfänger-E-Mail-Adresse (Ihre E-Mail-Adresse)
$empfaenger_email = "ihre_email@example.com";

// Betreff der E-Mail
$betreff = "Neue Formularanfrage";

// Formulardaten aus dem POST-Array abrufen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formulardaten = json_decode(file_get_contents("php://input"), true);

    // Daten aus dem ersten Abschnitt (Fahrzeugdaten)
    $hersteller = $formulardaten["hersteller"];
    $modell = $formulardaten["modell"];
    $leistung = $formulardaten["leistung"];
    $leistungEinheit = $formulardaten["leistungEinheit"];
    $getriebe = $formulardaten["getriebe"];
    $kraftstoff = $formulardaten["kraftstoff"];

    // Daten aus dem zweiten Abschnitt (Zusätzliche Informationen)
    $erstzulassungMonat = $formulardaten["erstzulassungMonat"];
    $erstzulassungJahr = $formulardaten["erstzulassungJahr"];
    $kilometerstand = $formulardaten["kilometerstand"];
    $anmerkungen = $formulardaten["anmerkungen"];
    $preisvorstellung = $formulardaten["preisvorstellung"];

    // Daten aus dem dritten Abschnitt (Persönliche Daten)
    $name = $formulardaten["name"];
    $strasse = $formulardaten["strasse"];
    $hausnummer = $formulardaten["hausnummer"];
    $plz = $formulardaten["plz"];
    $ort = $formulardaten["ort"];
    $telefon = $formulardaten["telefon"];
    $email = $formulardaten["email"];

    // E-Mail-Nachricht erstellen
    $nachricht = "Neue Formularanfrage\n\n";
    $nachricht .= "Fahrzeugdaten:\n";
    $nachricht .= "Hersteller: $hersteller\n";
    $nachricht .= "Modell: $modell\n";
    $nachricht .= "Leistung: $leistung $leistungEinheit\n";
    $nachricht .= "Getriebe: $getriebe\n";
    $nachricht .= "Kraftstoff: $kraftstoff\n\n";
    $nachricht .= "Zusätzliche Informationen:\n";
    $nachricht .= "Erstzulassung: $erstzulassungMonat/$erstzulassungJahr\n";
    $nachricht .= "Kilometerstand: $kilometerstand\n";
    $nachricht .= "Anmerkungen: $anmerkungen\n";
    $nachricht .= "Preisvorstellung: $preisvorstellung\n\n";
    $nachricht .= "Persönliche Daten:\n";
    $nachricht .= "Name: $name\n";
    $nachricht .= "Straße: $strasse\n";
    $nachricht .= "Hausnummer: $hausnummer\n";
    $nachricht .= "PLZ: $plz\n";
    $nachricht .= "Ort: $ort\n";
    $nachricht .= "Telefon: $telefon\n";
    $nachricht .= "E-Mail: $email\n";

    // E-Mail senden
    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    mail($empfaenger_email, $betreff, $nachricht, $headers);

    // Erfolgsmeldung an das JavaScript senden
    echo "success";
} else {
    // Fehlermeldung an das JavaScript senden
    echo "error";
}
?>