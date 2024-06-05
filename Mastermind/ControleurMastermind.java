import java.awt.Color;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.Serializable;

import javax.swing.JButton;

public class ControleurMastermind implements ActionListener, Serializable {

	private static final long serialVersionUID = -8666599224896772894L;
	private VueMastermind vue;
	private ModeleMastermind modele;
	
	private Color couleur;
	private int rang;
	
	private enum Etat {
		DEBUT_COMBINAISON, 
		CHOIX_COULEUR, 
		CHOIX_POSITION;
	}
	
	private Etat etat;
	
	public ControleurMastermind(VueMastermind vue, ModeleMastermind modele) {
		this.vue = vue;
		this.modele = modele;
		this.etat = Etat.DEBUT_COMBINAISON;
		this.modele.genererCombinaison();
		this.rang = 0;
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		JButton bouton = (JButton) arg0.getSource();
		switch (this.etat) {
		case DEBUT_COMBINAISON:
			if (this.vue.appartientPalette(bouton)) {
				this.couleur = bouton.getBackground();
				this.etat = Etat.CHOIX_COULEUR;
			}
			break;
		case CHOIX_COULEUR:
			if (this.vue.appartientCombinaison(bouton, this.rang)) {
				bouton.setBackground(this.couleur);
				this.etat = Etat.CHOIX_POSITION;
			}
			break;
		case CHOIX_POSITION:
			if (this.vue.appartientPalette(bouton)) {
				this.couleur = bouton.getBackground();
				this.etat = Etat.CHOIX_COULEUR;
			} else if (!this.vue.appartientCombinaison(bouton, this.rang)
					&& this.vue.combinaisonComplete(this.rang)) {
				if (this.rang <= VueMastermind.NBMAX_COMBINAISONS
						&& this.modele.nbChiffresBienPlaces(this.vue.combinaisonEnEntiers(this.rang)) != this.vue.getTaille()) {
					this.vue.afficherBP(this.rang, this.modele.nbChiffresBienPlaces(this.vue.combinaisonEnEntiers(this.rang)));
					this.vue.afficherMP(this.rang, this.modele.nbChiffresMalPlaces(this.vue.combinaisonEnEntiers(this.rang)));
					this.vue.desactiverCombinaison(this.rang);
					this.rang++;
					this.vue.activerCombinaison(this.rang);
					this.etat = Etat.DEBUT_COMBINAISON;
				} else {
					this.vue.afficherBP(this.rang, this.modele.nbChiffresBienPlaces(this.vue.combinaisonEnEntiers(this.rang)));
					this.vue.afficherMP(this.rang, this.modele.nbChiffresMalPlaces(this.vue.combinaisonEnEntiers(this.rang)));
					this.vue.desactiverCombinaison(this.rang);
					this.vue.afficherCombinaisonOrdinateur(this.modele.getCombinaison());
				}
			}
			break;
		}
	}

}
