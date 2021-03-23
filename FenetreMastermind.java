import java.awt.BorderLayout;
import java.awt.Color;
import java.awt.HeadlessException;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;

import javax.swing.JFrame;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JOptionPane;
import javax.swing.JPanel;

public class FenetreMastermind extends JFrame {
	
	private VueMastermind vue;
	
	private JMenuItem itemNbCouleurs;
	
	private JMenuItem itemTailleCombinaison;

	private static final long serialVersionUID = -2471881106581549761L;

	public FenetreMastermind(VueMastermind vue) throws HeadlessException {
		super();
		
		this.vue = vue;
		
		this.setTitle("Mastermind");
		this.setLayout(new BorderLayout());
		
		//ajout du menu
		JPanel panMenu = new JPanel();
		panMenu.setLayout(new BorderLayout());
		this.add(panMenu, BorderLayout.NORTH);
		JMenuBar menuBar = new JMenuBar();
		panMenu.add(menuBar, BorderLayout.WEST);
		JMenu jeu = new JMenu("Jeu");
		JMenu options = new JMenu("Options");
		menuBar.add(jeu);
		menuBar.add(options);
		
		// jeu
		JMenuItem rejouer = new JMenuItem("Rejouer");
		jeu.add(rejouer);
		rejouer.addActionListener(new ControleurRejouer(this));
		JMenuItem sauvegarder = new JMenuItem("Sauvegarder");
		jeu.add(sauvegarder);
		sauvegarder.addActionListener(new ControleurSauvegarder(this));
		JMenuItem restaurer = new JMenuItem("Restaurer");
		jeu.add(restaurer);
		restaurer.addActionListener(new ControleurRestaurer(this));
		jeu.addSeparator();
		JMenuItem quitter = new JMenuItem("Quitter");
		jeu.add(quitter);
		quitter.addActionListener(new ControleurQuitter(this));
		
		// options
		JMenu nbCouleurs = new JMenu("nombre de couleurs");
		options.add(nbCouleurs);
		JMenu tailleCombinaison = new JMenu("taille combinaison");
		options.add(tailleCombinaison);
		
		JMenuItem[] nbCouleursItem = new JMenuItem[9];
		JMenuItem[] tailleCombinaisonItem = new JMenuItem[9];
		for (int i = 0 ; i < 9 ; i++) {
			// ajout des items couleur
			nbCouleursItem[i] = new JMenuItem("" + (i + 2));
			nbCouleursItem[i].addActionListener(new ControleurNbCouleurs(this));
			nbCouleurs.add(nbCouleursItem[i]);
			
			// ajout des items taille
			tailleCombinaisonItem[i] = new JMenuItem("" + (i + 2));
			tailleCombinaisonItem[i].addActionListener(new ControleurTailleCombinaison(this));
			tailleCombinaison.add(tailleCombinaisonItem[i]);
		}
		this.changerItemNbCouleurs(nbCouleursItem[this.vue.getNbCouleurs() - 2]);
		
		this.changerItemTailleCombinaison(tailleCombinaisonItem[this.vue.getTaille() - 2]);
		
		// ajout de la vue mastermind
		this.add(this.vue, BorderLayout.CENTER);
		
		this.pack();
		this.setVisible(true);
		this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	}
	
	public void changerItemNbCouleurs(JMenuItem item) {
		if (this.itemNbCouleurs != null) {
			this.itemNbCouleurs.setBackground(null);
		}
		this.itemNbCouleurs = item;
		this.itemNbCouleurs.setBackground(Color.RED);
	}
	
	public void changerItemTailleCombinaison(JMenuItem item) {
		if (this.itemTailleCombinaison != null) {
			this.itemTailleCombinaison.setBackground(null);
		}
		this.itemTailleCombinaison = item;
		this.itemTailleCombinaison.setBackground(Color.GREEN);
	}
	
	public void creerNouvelleVueMasterMind() {
		this.remove(this.vue);
		this.vue = new VueMastermind(Integer.valueOf(this.itemTailleCombinaison.getText()), Integer.valueOf(this.itemNbCouleurs.getText()));
		this.add(this.vue, BorderLayout.CENTER);
		this.pack();
		this.setVisible(true);
	}
	
	public void restaurerVueMastermindFichier(String nomFichier) throws FileNotFoundException, IOException, ClassNotFoundException {
		int reponse = JOptionPane.showConfirmDialog(null, "Voulez-vous vraiment restaurer le dernier jeu ?");
		if (reponse == JOptionPane.YES_OPTION) {
			this.remove(this.vue);
			ObjectInputStream in = new ObjectInputStream(new FileInputStream(nomFichier));
			this.vue = (VueMastermind) in.readObject();
			this.add(this.vue, BorderLayout.CENTER);
			in.close();
			this.pack();
			this.setVisible(true);
			this.repaint();
		}
	}
	
	public void sauvegarderVueMastermindFichier(String nomFichier) throws FileNotFoundException, IOException {
		int reponse = JOptionPane.showConfirmDialog(null, "Voulez-vous vraiment sauvegarder la partie ?");
		if (reponse == JOptionPane.YES_OPTION) {
			ObjectOutputStream out = new ObjectOutputStream(new FileOutputStream(nomFichier));
			out.writeObject(this.vue);
			out.close();
		}
	}

}
