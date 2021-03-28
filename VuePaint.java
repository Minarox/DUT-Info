// Bibliothèques
import javax.swing.*;
import javax.swing.border.TitledBorder;
import javax.swing.event.ChangeEvent;
import javax.swing.event.ChangeListener;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.WindowEvent;
import java.io.IOException;

/**
 * Affichage des différentes fenêtres du programme
 * @author Mathis SERRIERES MANIEKCI
 * @version 0.1
 */
public class VuePaint extends JFrame {

    // Variables
    private ControleurPaint controleur;
    private JPanel panneau, panneauControle, panneauFormes, panneauCouleurs, panneauOpacite, affichageCouleurPinceau, affichageCouleurFond;
    private TitledBorder controles, formes, couleurs, opacite;
    private JButton boutonNouveau, boutonOuvrir, boutonEnregistrer, boutonFormeLibre, boutonFormeLigneX, boutonFormeLigneY, boutonFormeRectangle, boutonFormeOvale, boutonChoixCouleurPinceau, boutonChoixCouleurFond;
    private JLabel texteCouleurPinceau, texteCouleurFond, texteOpacite;
    private JSeparator separateurCouleurs, separateurOpacite;
    private JSlider choixOpacite;
    private Dimension dimension = new Dimension(30, 30);
    private Color selection = new Color(204, 255, 179, 255);

    /**
     * Constructeur permettant de générer la fenêtre principale du programme
     */
    public VuePaint() {
        // Création et paramétrage de la fenêtre
        this.setLayout(new BorderLayout());
        this.setTitle("Paint v0.1");
        this.setSize(1416, 800);
        this.setResizable(false);
        this.setLocationRelativeTo(null);
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // Panneau contenant toutes les fonctionnalités de l'application
        panneau = new JPanel();
        panneau.setPreferredSize(new Dimension(1400, 75));
        panneau.setBorder(BorderFactory.createMatteBorder(0, 0, 1, 0, Color.BLACK));
        this.add(panneau, BorderLayout.NORTH);

        // Panneau de contrôle contenant les actions de bases comme "nouveau", "ouvrir" ou "enregistrer"
        panneauControle = new JPanel();
        controles = BorderFactory.createTitledBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.GRAY), "Contrôles");
        controles.setTitleJustification(TitledBorder.CENTER);
        panneauControle.setBorder(controles);
        panneau.add(panneauControle);
        // Nouveau dessin
        boutonNouveau = new JButton();
        boutonNouveau.setIcon(new ImageIcon("images/nouveau.png", "Nouveau dessin"));
        boutonNouveau.setPreferredSize(dimension);
        boutonNouveau.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                affichageCouleurFond.setBackground(Color.WHITE);
                affichageCouleurPinceau.setBackground(Color.black);
                boutonFormeLibre.setBackground(selection);
                boutonFormeLigneX.setBackground(null);
                boutonFormeLigneY.setBackground(null);
                boutonFormeRectangle.setBackground(null);
                boutonFormeOvale.setBackground(null);
                choixOpacite.setValue(255);
                controleur.nouveau();
            }
        });
        panneauControle.add(boutonNouveau);
        // Ouvrir une image
        boutonOuvrir = new JButton();
        boutonOuvrir.setIcon(new ImageIcon("images/ouvrir.png", "Ouvrir un dessin"));
        boutonOuvrir.setPreferredSize(dimension);
        boutonOuvrir.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                try {
                    controleur.ouvrir();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        });
        panneauControle.add(boutonOuvrir);
        // Enregistrer le dessin
        boutonEnregistrer = new JButton();
        boutonEnregistrer.setIcon(new ImageIcon("images/enregistrer.png", "Enregistrer le dessin"));
        boutonEnregistrer.setPreferredSize(dimension);
        boutonEnregistrer.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                try {
                    controleur.enregistrer();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        });
        panneauControle.add(boutonEnregistrer);

        // Panneau des formes contenant les boutons de sélection de formes
        panneauFormes = new JPanel();
        formes = BorderFactory.createTitledBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.GRAY), "Formes");
        formes.setTitleJustification(TitledBorder.CENTER);
        panneauFormes.setBorder(formes);
        panneau.add(panneauFormes);
        // Forme libre
        boutonFormeLibre = new JButton();
        boutonFormeLibre.setIcon(new ImageIcon("images/libre.png", "Dessin libre"));
        boutonFormeLibre.setPreferredSize(dimension);
        boutonFormeLibre.setBackground(selection);
        boutonFormeLibre.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                boutonFormeLibre.setBackground(selection);
                boutonFormeLigneX.setBackground(null);
                boutonFormeLigneY.setBackground(null);
                boutonFormeRectangle.setBackground(null);
                boutonFormeOvale.setBackground(null);
                controleur.dessinLibre();
            }
        });
        panneauFormes.add(boutonFormeLibre);
        // Forme ligne horizontale
        boutonFormeLigneX = new JButton();
        boutonFormeLigneX.setIcon(new ImageIcon("images/ligneX.png", "Ligne"));
        boutonFormeLigneX.setPreferredSize(dimension);
        boutonFormeLigneX.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                boutonFormeLibre.setBackground(null);
                boutonFormeLigneX.setBackground(selection);
                boutonFormeLigneY.setBackground(null);
                boutonFormeRectangle.setBackground(null);
                boutonFormeOvale.setBackground(null);
                controleur.dessinLigneX();
            }
        });
        panneauFormes.add(boutonFormeLigneX);
        // Forme ligne verticale
        boutonFormeLigneY = new JButton();
        boutonFormeLigneY.setIcon(new ImageIcon("images/ligneY.png", "Ligne"));
        boutonFormeLigneY.setPreferredSize(dimension);
        boutonFormeLigneY.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                boutonFormeLibre.setBackground(null);
                boutonFormeLigneX.setBackground(null);
                boutonFormeLigneY.setBackground(selection);
                boutonFormeRectangle.setBackground(null);
                boutonFormeOvale.setBackground(null);
                controleur.dessinLigneY();
            }
        });
        panneauFormes.add(boutonFormeLigneY);
        // Forme rectangle
        boutonFormeRectangle = new JButton();
        boutonFormeRectangle.setIcon(new ImageIcon("images/rectangle.png", "Rectangle"));
        boutonFormeRectangle.setPreferredSize(dimension);
        boutonFormeRectangle.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                boutonFormeLibre.setBackground(null);
                boutonFormeLigneX.setBackground(null);
                boutonFormeLigneY.setBackground(null);
                boutonFormeRectangle.setBackground(selection);
                boutonFormeOvale.setBackground(null);
                controleur.dessinRectangle();
            }
        });
        panneauFormes.add(boutonFormeRectangle);
        // Forme ovale
        boutonFormeOvale = new JButton();
        boutonFormeOvale.setIcon(new ImageIcon("images/cercle.png", "Cercle"));
        boutonFormeOvale.setPreferredSize(dimension);
        boutonFormeOvale.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                boutonFormeLibre.setBackground(null);
                boutonFormeLigneX.setBackground(null);
                boutonFormeLigneY.setBackground(null);
                boutonFormeRectangle.setBackground(null);
                boutonFormeOvale.setBackground(selection);
                controleur.dessinOvale();
            }
        });
        panneauFormes.add(boutonFormeOvale);

        // Panneau des couleurs permettant de sélectionner la couleur du pinceau et du fond
        panneauCouleurs = new JPanel();
        couleurs = BorderFactory.createTitledBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.GRAY), "Couleurs");
        couleurs.setTitleJustification(TitledBorder.CENTER);
        panneauCouleurs.setBorder(couleurs);
        panneau.add(panneauCouleurs);
        // Couleur de pinceau
        texteCouleurPinceau = new JLabel("Couleur du pinceau :");
        panneauCouleurs.add(texteCouleurPinceau);
        affichageCouleurPinceau = new JPanel();
        affichageCouleurPinceau.setBorder(BorderFactory.createLineBorder(Color.black));
        affichageCouleurPinceau.setPreferredSize(dimension);
        affichageCouleurPinceau.setBackground(Color.black);
        panneauCouleurs.add(affichageCouleurPinceau);
        boutonChoixCouleurPinceau = new JButton();
        boutonChoixCouleurPinceau.setIcon(new ImageIcon("images/couleurs.png", "Couleur du pinceau"));
        boutonChoixCouleurPinceau.setPreferredSize(dimension);
        boutonChoixCouleurPinceau.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                Color couleurPinceau = JColorChooser.showDialog(null, "Couleur du pinceau", Color.black);
                if (couleurPinceau == null) {
                    throw new NullPointerException("Annulation du choix de la couleur.");
                }
                affichageCouleurPinceau.setBackground(couleurPinceau);
                controleur.setCouleurPinceau(couleurPinceau);
            }
        });
        panneauCouleurs.add(boutonChoixCouleurPinceau);
        separateurCouleurs = new JSeparator();
        separateurCouleurs.setOrientation(SwingConstants.VERTICAL);
        separateurCouleurs.setPreferredSize(new Dimension(2, 30));
        panneauCouleurs.add(separateurCouleurs);
        // Couleur de fond
        texteCouleurFond = new JLabel("Couleur du fond :");
        panneauCouleurs.add(texteCouleurFond);
        affichageCouleurFond = new JPanel();
        affichageCouleurFond.setBorder(BorderFactory.createLineBorder(Color.black));
        affichageCouleurFond.setPreferredSize(dimension);
        affichageCouleurFond.setBackground(Color.white);
        panneauCouleurs.add(affichageCouleurFond);
        boutonChoixCouleurFond = new JButton();
        boutonChoixCouleurFond.setIcon(new ImageIcon("images/couleurs.png", "Couleur du fond"));
        boutonChoixCouleurFond.setPreferredSize(dimension);
        boutonChoixCouleurFond.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent event) {
                Color couleurFond = JColorChooser.showDialog(null, "Couleur du fond", Color.black);
                if (couleurFond == null) {
                    throw new NullPointerException("Annulation du choix de la couleur.");
                }
                affichageCouleurFond.setBackground(couleurFond);
                controleur.setCouleurFond(couleurFond);
            }
        });
        panneauCouleurs.add(boutonChoixCouleurFond);

        // Panneau de l'opacité permettant de modifier l'opacité du pinceau
        panneauOpacite = new JPanel();
        opacite = BorderFactory.createTitledBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.GRAY), "Opacité");
        opacite.setTitleJustification(TitledBorder.CENTER);
        panneauOpacite.setBorder(opacite);
        panneau.add(panneauOpacite);
        // Slider pour sélectionner l'opacité
        choixOpacite = new JSlider(0, 255, 255);
        choixOpacite.setPreferredSize(new Dimension(180, 30));
        choixOpacite.addChangeListener(new ChangeListener() {
            @Override
            public void stateChanged(ChangeEvent changeEvent) {
                int valeurOpacite = choixOpacite.getValue();
                texteOpacite.setText("Valeur : " + valeurOpacite);
                controleur.setOpacite(valeurOpacite);
            }
        });
        panneauOpacite.add(choixOpacite);
        separateurOpacite = new JSeparator();
        separateurOpacite.setOrientation(SwingConstants.VERTICAL);
        separateurOpacite.setPreferredSize(new Dimension(2, 30));
        panneauOpacite.add(separateurOpacite);
        texteOpacite = new JLabel("Valeur : " + choixOpacite.getValue());
        panneauOpacite.add(texteOpacite);

        // Panneau de dessin affichant la zone de dessin et le dessin
        controleur = new ControleurPaint();
        controleur.setPreferredSize(new Dimension(1400, 690));
        this.add(controleur, BorderLayout.SOUTH);

        // Affichage de la fenêtre principale et appel à la fenêtre de bienvenue
        this.setVisible(true);
        popupDemarrage();
    }

    /**
     * Fenêtre de démarrage pour accueillir l'utilisateur
     */
    private void popupDemarrage() {
        // Création et paramétrage d'une nouvelle fenêtre
        JFrame popupDemarrage = new JFrame();
        popupDemarrage.setTitle("Bienvenue");
        popupDemarrage.setSize(550, 265);
        popupDemarrage.setResizable(false);
        popupDemarrage.setLocationRelativeTo(null);
        popupDemarrage.setAlwaysOnTop(true);

        // Nouveau panneau de disposition
        JPanel disposition = new JPanel();
        popupDemarrage.add(disposition, BorderLayout.NORTH);
        // Ajout d'un message
        JTextArea message = new JTextArea("Bienvenue sur Paint V0.1\n\n\n" +
                "Cette application vous permet de dessiner sur une grande feuille blanche.\n\n" +
                "Vous disposez de plusieurs outils vous permettant de réaliser\n" +
                "des formes différentes comme des lignes, des rectangles ou encore des cercles.\n" +
                "Vous pouvez aussi contrôler la couleur et l'opacité du pinceau, la couleur de fond,\n" +
                "mais aussi ouvrir une image ou enregistrer votre dessin.\n\n" +
                "Amusez-vous bien !");
        message.setFocusable(false);
        message.setBackground(new Color(238, 238, 238));
        disposition.add(message);
        // Ajout d'un bouton de confirmation
        JPanel dispositionBouton = new JPanel();
        popupDemarrage.add(dispositionBouton, BorderLayout.SOUTH);
        JButton confirmation = new JButton("C'est parti");
        confirmation.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent actionEvent) {
                popupDemarrage.dispatchEvent(new WindowEvent(popupDemarrage, WindowEvent.WINDOW_CLOSING));
            }
        });
        dispositionBouton.add(confirmation);

        // Affichage de la fenêtre
        popupDemarrage.setVisible(true);
    }

}
