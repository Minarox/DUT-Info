import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.FlowLayout;
import java.awt.GridLayout;

import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JPanel;
import javax.swing.JTextField;

public class VueMastermind extends JPanel {
	
	private static final long serialVersionUID = -5866612673564416902L;

	public static final int NBMAX_COMBINAISONS = 10;

	private static final Color[] COLORS = {Color.BLUE, Color.RED, Color.GREEN, Color.YELLOW, Color.CYAN, Color.MAGENTA,Color.ORANGE,Color.WHITE,Color.PINK,Color.BLACK};
	
	private JTextField[] bPIHM;
	
	private JTextField[] mPIHM;
	
	private JTextField[] combinaisonsOrdiIHM;
	
	private JButton[][] combinaisonsJoueursIHM;
	
	private int nbCouleurs;
	
	private JButton[] paletteIHM;
	
	private int taille;
	
	private ControleurMastermind controleur;
	
	public VueMastermind(int taille, int nbCouleurs) {
		super();
		
		this.setLayout(new BorderLayout());
		
		this.nbCouleurs = nbCouleurs;
		
		this.taille = taille;
		
		// Panel Nord
		JPanel panNord = new JPanel();
		this.add(panNord, BorderLayout.NORTH);
		panNord.setLayout(new FlowLayout());
		
		panNord.add(new JLabel("Couleurs :"));
		
		JPanel couleurs = new JPanel();
		panNord.add(couleurs);
		couleurs.setLayout(new GridLayout(1, this.nbCouleurs));
		this.paletteIHM = new JButton[this.nbCouleurs];
		for (int i = 0 ; i < this.paletteIHM.length ; i++) {
			this.paletteIHM[i] = new JButton();
			this.paletteIHM[i].setBackground(VueMastermind.COLORS[i]);
			couleurs.add(this.paletteIHM[i]);
		}
		
		// Panel Central
		JPanel panCentre = new JPanel();
		this.add(panCentre, BorderLayout.CENTER);
		panCentre.setLayout(new GridLayout(NBMAX_COMBINAISONS, 2));
		
		JPanel[] panneauxPlacement = new JPanel[NBMAX_COMBINAISONS];
		this.bPIHM = new JTextField[NBMAX_COMBINAISONS];
		this.mPIHM = new JTextField[NBMAX_COMBINAISONS];
		for (int i = 0 ; i < NBMAX_COMBINAISONS ; i++) {
			this.bPIHM[i] = new JTextField();
			this.bPIHM[i].setEditable(false);
			this.mPIHM[i] = new JTextField();
			this.mPIHM[i].setEditable(false);
		}
		
		JPanel[] panneauxComb = new JPanel[NBMAX_COMBINAISONS];
		this.combinaisonsJoueursIHM = new JButton[NBMAX_COMBINAISONS][this.taille];
		for (int i = 0 ; i < NBMAX_COMBINAISONS ; i++) {
			panneauxComb[i] = new JPanel();
			panneauxComb[i].setLayout(new GridLayout(1, this.taille));
			for (int j = 0 ; j < this.taille ; j++) {
				this.combinaisonsJoueursIHM[i][j] = new JButton();
				if (i != 0) {
					this.combinaisonsJoueursIHM[i][j].setEnabled(false);
				}
				panneauxComb[i].add(this.combinaisonsJoueursIHM[i][j]);
			}
			panCentre.add(panneauxComb[i]);
			
			panneauxPlacement[i] = new JPanel();
			panneauxPlacement[i].setLayout(new GridLayout(2, 2));
			panneauxPlacement[i].add(new JLabel("BP"));
			panneauxPlacement[i].add(new JLabel("MP"));
			panneauxPlacement[i].add(this.bPIHM[i]);
			panneauxPlacement[i].add(this.mPIHM[i]);
			panCentre.add(panneauxPlacement[i]);
		}
		
		// Panel Sud
		JPanel panSud = new JPanel();
		this.add(panSud, BorderLayout.SOUTH);
		panSud.setLayout(new GridLayout(1, 2));
		
		JPanel panSolution = new JPanel();
		panSud.add(panSolution);
		panSolution.setLayout(new GridLayout(1, 4));
		this.combinaisonsOrdiIHM = new JTextField[this.taille];
		for (int i = 0 ; i < this.combinaisonsOrdiIHM.length ; i++) {
			this.combinaisonsOrdiIHM[i] = new JTextField();
			this.combinaisonsOrdiIHM[i].setEditable(false);
			panSolution.add(this.combinaisonsOrdiIHM[i]);
		}
		
		JButton valider = new JButton("valider");
		panSud.add(valider);
		
		// ajout des listeners
		this.controleur = new ControleurMastermind(this, new ModeleMastermind(this.taille, this.nbCouleurs));
		for (JButton b : this.paletteIHM) {
			b.addActionListener(this.controleur);
		}
		for (int i = 0 ; i < NBMAX_COMBINAISONS ; i++) {
			for (int j = 0 ; j < this.taille ; j++) {
				this.combinaisonsJoueursIHM[i][j].addActionListener(this.controleur);
			}
		}
		valider.addActionListener(this.controleur);
	}
	
	public static Color chiffreEnCouleur(int i) {
		return VueMastermind.COLORS[i];
	}
	
	public static int couleurEnChiffre(Color c) {
		for (int i = 0 ; i < VueMastermind.COLORS.length ; i++) {
			if (VueMastermind.COLORS[i].equals(c)) {
				return i;
			}
		}
		return 0;
	}
	
	public void activerCombinaison(int i) {
		for (int j = 0 ; j < this.taille ; j++) {
			this.combinaisonsJoueursIHM[i][j].setEnabled(true);
		}
	}
	
	public void desactiverCombinaison(int i) {
		for (int j = 0 ; j < this.taille ; j++) {
			this.combinaisonsJoueursIHM[i][j].setEnabled(false);
		}
	}
	
	public void afficherCombinaisonOrdinateur(int[] tableauCouleurs) {
		for (int i = 0 ; i < this.taille ; i++) {
			this.combinaisonsOrdiIHM[i].setBackground(VueMastermind.chiffreEnCouleur(tableauCouleurs[i]));
		}
	}

	public int getNbCouleurs() {
		return nbCouleurs;
	}

	public int getTaille() {
		return taille;
	}
	
	public boolean appartientCombinaison(JButton b, int i) {
		for (int j = 0 ; j < this.taille ; j++) {
			if (this.combinaisonsJoueursIHM[i][j] == b) {
				return true;
			}
		}
		return false;
	}
	
	public boolean appartientPalette(JButton b) {
		for (Color c : VueMastermind.COLORS) {
			if (b.getBackground().equals(c)) {
				return true;
			}
		}
		return false;
	}
	
	public boolean combinaisonComplete(int i) {
		for (int j = 0 ; j < this.taille ; j++) {
			if (!this.appartientPalette(this.combinaisonsJoueursIHM[i][j])) {
				return false;
			}
		}
		return true;
	}
	
	public int[] combinaisonEnEntiers(int i) {
		int[] tab = new int[this.taille];
		for (int j = 0 ; j < this.taille ; j++) {
			tab[j] = VueMastermind.couleurEnChiffre(this.combinaisonsJoueursIHM[i][j].getBackground());
		}
		return tab;
	}
	
	public void afficherMP(int i, int nbMP) {
		this.mPIHM[i].setText("" + nbMP);
	}
	
	public void afficherBP(int i, int nbBP) {
		this.bPIHM[i].setText("" + nbBP);
	}
	
}
