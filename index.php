/**
 * Haupt-Komponente für die gesamte App:
 * Der Inhalt könnte aus weiteren Komponenten bestehen, siehe render()
 */
class App extends React.Component {
	/**
	 * Wird beim Erstellen der Komponente aufgerufen
	 * @param {Object} props Eigenschaften, die übergeben wurden
	 */
	constructor(props) {
		super(props);

		// Verfügbare Variablen für diese Komponente
		this.state = {
			name: '',
			age: 1,
			email: '',
			contacts: []
		};
	}

	/**
	 * Namen mit dem Inhalt aus dem dazugehörigen Eingabefeld synchronisieren
	 * @param {Object} event Von React ausgelöstes Ereignis
	 */
	updateName(event) {
		this.setState({ name: event.target.value });
	}

	/**
	 * Alter mit der Zahl aus dem dazugehörigen Eingabefeld synchronisieren
	 * @param {Object} event Von React ausgelöstes Ereignis
	 */
	updateAge(event) {
		this.setState({ age: parseInt(event.target.value) });
	}

	/**
	 * Email-Adresse mit dem Inhalt aus dem dazugehörigen Eingabefeld synchronisieren
	 * @param {Object} event Von React ausgelöstes Ereignis
	 */
	updateEmail(event) {
		this.setState({ email: event.target.value });
	}

	/**
	 * Neuen Kontakt zur Kontaktliste hinzufügen
	 * @param {Object} event Von React ausgelöstes Ereignis
	 */
	addContact(event) {
		// Für den neuen Kontakt werden die Werte aus den Eingabefeldern verwendet
		var newContact = { name: this.state.name, age: this.state.age, email: this.state.email };
		// Kontaktliste für diese Komponente aktualisieren
		this.setState({ contacts: this.state.contacts.concat(newContact) });
	}

	/**
	 * Kontakt anhand der Email-Adresse finden und aus der Kontaktliste entfernen
	 * @param {String} email Email-Adresse des Kontakts
	 */
	removeContact(email) {
		// Neue gefilterte Kontaktliste erstellen
		var newContacts = this.state.contacts.filter(contact => {
			// Es werden nur diejenigen Kontakte NICHT herausgefiltert,
			// die eine abweichende E-Mail-Adresse haben
			return contact.email != email;
		});
		// Kontaktliste für diese Komponente aktualisieren
		this.setState({ contacts: newContacts });
	}

	/**
	 * Darstellung konstruieren
	 * @return {String} HTML-Code für diese Komponente
	 */
	render() {
		return (
			<React.Fragment>
				<h1>Kontakte</h1>

				<h2>Neuen Kontakt erstellen</h2>
				<label>
					Name:
					<input value={this.state.name} onChange={this.updateName.bind(this)} type="text" />
				</label>
				<label>
					Alter:
					<input value={this.state.age} onChange={this.updateAge.bind(this)} type="number" min="1" />
				</label>
				<label>
					E-Mail-Adresse:
					<input value={this.state.email} onChange={this.updateEmail.bind(this)} type="email" />
				</label>
				<button
					onClick={this.addContact.bind(this)}
					disabled={this.state.name == '' || this.state.age == 0 || this.state.email == ''}
				>
					Kontakt hinzufügen
				</button>

				<h2>Alle Kontaktdaten</h2>
				{this.state.contacts.length ? (
					<ul>
						{this.state.contacts.map((contact, index) => {
							return (
								<li key={index}>
									<button onClick={this.removeContact.bind(this, contact.email)}>Entfernen</button>
									{contact.name} ({contact.age}): {contact.email}
								</li>
							);
						})}
					</ul>
				) : (
					<span>Keine Kontaktdaten gefunden.</span>
				)}
			</React.Fragment>
		);
	}
}

// Inhalt auf der Webseite darstellen
ReactDOM.render(<App />, document.getElementById('root'));
