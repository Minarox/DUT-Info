// Bibliothèques
import javax.imageio.ImageIO;
import javax.swing.*;
import javax.swing.filechooser.FileNameExtensionFilter;
import java.awt.*;
import java.awt.event.*;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;

/**
 * Permet de dessiner dans la zone avec différents paramètres modifiables
 * @author Mathis SERRIERES MANIEKCI
 * @version 0.1
 */

public class ControleurPaint extends JComponent {

    // Variables
    private Image image;
    private Graphics2D dessin;
    private Color couleurPinceau, couleurFond;
    private int x, y, appuiX, appuiY, valeurOpacite;
    private MouseMotionAdapter deplacementSouris;
    private MouseAdapter relachementSouris;

    /**
     * Contructeur permettant de mettre en place la zone de dessin avec l'outil par défaut
     */
    public ControleurPaint() {
        // Lancement des écouteurs pour la souris et sélection de l'outil par défaut
        ecouteurSouris();
        dessinLibre();
    }

    /**
     * Paramétrage de la zone de dessin
     * @param affichage Element graphique permettant l'affichage du dessin
     */
    protected void paintComponent(Graphics affichage) {
        if (image == null) {
            // Création de l'image qui contient la zone de dessin
            image = createImage(getSize().width, getSize().height);
            // Ajout du contenu de l'image dans le dessin
            dessin = (Graphics2D) image.getGraphics();
            // Paramètres de rendu du dessin
            dessin.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);
            // Nouvelle zone de dessin vierge
            nouveau();
        }
        // Affichage du dessin dans la zone
        affichage.drawImage(image, 0, 0, null);
    }

    /**
     * Met en place un écouteur pour connaitre la position de la souris à l'appui sur la zone
     */
    private void ecouteurSouris() {
        // Ajout d'un écouteur pour connaitre la position à l'appui de la souris
        this.addMouseListener(new MouseAdapter() {
            @Override
            public void mousePressed(MouseEvent appuiSouris) {
                // Position X et Y sur le tableau
                appuiX = appuiSouris.getX();
                appuiY = appuiSouris.getY();
            }
        });
    }

    /**
     * Génère une zone de dessin vierge
     */
    public void nouveau() {
        // Modifie la couleur et remplie la zone de dessin
        dessin.setPaint(Color.white);
        dessin.fillRect(0, 0, getSize().width, getSize().height);
        // Redéfinition des paramètres de bases
        couleurFond = Color.white;
        couleurPinceau = Color.black;
        valeurOpacite = 255;
        dessin.setPaint(Color.black);
        // Actualisation de l'affichage du dessin et sélection de l'outil par défaut
        repaint();
        dessinLibre();
    }

    /**
     * Permet d'ouvrir une image souhaité
     * @throws IOException Annulation de l'action
     */
    public void ouvrir() throws IOException {
        // Ajout d'une fenêtre permettant d'ouvrir l'image que l'on souhaite
        JFileChooser fichier = new JFileChooser();
        // Filtre pour ne sélectionner que certaines extensions de fichier
        fichier.setFileFilter(new FileNameExtensionFilter("Format d'image optimal : 1400x690 (JPG ou PNG)", "jpg", "png"));
        // Affichage de la fenêtre d'ouverture
        fichier.showDialog(null, "Ouvrir");
        // Exception si l'action est annulée
        if (fichier.getSelectedFile() != null) {
            // Lecture et ajout de l'image dans le dessin
            Image img = ImageIO.read(new File(fichier.getSelectedFile().getPath()));
            dessin.drawImage(img, 0, 0, getWidth(), getHeight(), this);
            // Actualisation de l'affichage du dessin
            repaint();
        } else {
            // Nouvelle exception si l'action est annulée
            throw new IllegalArgumentException("Aucun fichier sélectionné.");
        }
    }

    /**
     * Enregistre le dessin à un emplacement souhaité
     * @throws IOException Annulation de l'action
     */
    public void enregistrer() throws IOException {
        // Ajout d'un BufferedImage permettant la conversion du dessin en image "enregistrable"
        BufferedImage dessinImage = new BufferedImage(image.getWidth(null), image.getHeight(null), BufferedImage.TYPE_INT_ARGB);
        // Ajout d'un composant graphique temporaire pour générer l'image
        Graphics2D dessinTemp = (Graphics2D) dessinImage.getGraphics();
        // Ajout du dessin dans le composant graphique temporaire
        dessinTemp.drawImage(image, 0, 0, null);
        dessinTemp.dispose();
        // Ajout d'une fenêtre permettant d'enregistrer ou l'on souhaite le dessin
        JFileChooser fichier = new JFileChooser();
        // Filtre pour ne sélectionner que certaines extensions de fichier
        fichier.setFileFilter(new FileNameExtensionFilter("Image PNG", "png"));
        // Affichage de la fenêtre d'enregistrement
        fichier.showDialog(null, "Enregistrer");
        // Exception si l'action est annulée
        if (fichier.getSelectedFile() != null) {
            // Création de l'image à l'endroit définit
            ImageIO.write(dessinImage, "png", new File(String.valueOf(fichier.getSelectedFile())));
        } else {
            // Nouvelle exception si l'action est annulée
            throw new IllegalArgumentException("Aucun emplacement sélectionné.");
        }
    }

    /**
     * Outil de forme libre permettant de dessiner ce que l'on souhaite
     */
    public void dessinLibre() {
        // Suppression des anciens écouteurs
        this.removeMouseListener(relachementSouris);
        this.removeMouseMotionListener(deplacementSouris);
        // Définition d'un nouvel écouteur
        deplacementSouris = new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent deplacementSouris) {
                // Position X et Y sur le tableau
                x = deplacementSouris.getX();
                y = deplacementSouris.getY();
                if (dessin != null) {
                    // Dessine une ligne entre l'ancienne position et la nouvelle
                    dessin.drawLine(appuiX, appuiY, x, y);
                    // Actualisation de l'affichage du dessin
                    repaint();
                    // Replacement des coordonnées
                    appuiX = x;
                    appuiY = y;
                }
            }
        };
        // Ajout de l'écouteur au controleur
        this.addMouseMotionListener(deplacementSouris);
    }

    /**
     * Outil ligne horizontal permettant de dessiner des lignes sur l'axe X
     */
    public void dessinLigneX() {
        // Suppression des anciens écouteurs
        this.removeMouseListener(relachementSouris);
        this.removeMouseMotionListener(deplacementSouris);
        // Définition d'un nouvel écouteur
        deplacementSouris = new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent deplacementSouris) {
                // Position X et Y sur le tableau
                x = deplacementSouris.getX();
                y = deplacementSouris.getY();
                if (dessin != null) {
                    // Dessine une ligne sur l'axe X
                    dessin.drawLine(appuiX, appuiY, x, appuiY);
                    // Actualisation de l'affichage du dessin
                    repaint();
                }
            }
        };
        // Ajout de l'écouteur au controleur
        this.addMouseMotionListener(deplacementSouris);
    }

    /**
     * Outil ligne vertical permettant de dessiner des lignes sur l'axe Y
     */
    public void dessinLigneY() {
        // Suppression des anciens écouteurs
        this.removeMouseListener(relachementSouris);
        this.removeMouseMotionListener(deplacementSouris);
        // Définition d'un nouvel écouteur
        deplacementSouris = new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent deplacementSouris) {
                // Position X et Y sur le tableau
                x = deplacementSouris.getX();
                y = deplacementSouris.getY();
                if (dessin != null) {
                    // Dessine une ligne sur l'axe Y
                    dessin.drawLine(appuiX, appuiY, appuiX, y);
                    // Actualisation de l'affichage du dessin
                    repaint();
                }
            }
        };
        // Ajout de l'écouteur au controleur
        this.addMouseMotionListener(deplacementSouris);
    }

    /**
     * Outil Rectangle permettant de dessiner des rectangles
     */
    public void dessinRectangle() {
        // Suppression des anciens écouteurs
        this.removeMouseListener(relachementSouris);
        this.removeMouseMotionListener(deplacementSouris);
        // Définition d'un nouvel écouteur
        deplacementSouris = new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent deplacementSouris) {
                // Position X et Y sur le tableau
                x = deplacementSouris.getX();
                y = deplacementSouris.getY();
                if (dessin != null) {
                    // Remplie une zone rectangulaire entre l'ancienne position et la nouvelle
                    dessin.fillRect(appuiX, appuiY, x - appuiX, y - appuiY);
                    // Actualisation de l'affichage du dessin
                    repaint();
                }
            }
        };
        // Ajout de l'écouteur au controleur
        this.addMouseMotionListener(deplacementSouris);
    }

    /**
     * Outil Ovale permettant de dessiner des formes circulaires
     */
    public void dessinOvale() {
        // Suppression des anciens écouteurs
        this.removeMouseListener(relachementSouris);
        this.removeMouseMotionListener(deplacementSouris);
        // Définition d'un nouvel écouteur
        deplacementSouris = new MouseMotionAdapter() {
            @Override
            public void mouseDragged(MouseEvent deplacementSouris) {
                // Position X et Y sur le tableau
                x = deplacementSouris.getX();
                y = deplacementSouris.getY();
            }
        };
        // Ajout de l'écouteur au controleur
        this.addMouseMotionListener(deplacementSouris);
        // Permet de contourner un problème d'affichage de la forme causé par le remplissement lors du déplacement de la souris
        relachementSouris = new MouseAdapter() {
            @Override
            public void mouseReleased(MouseEvent mouseEvent) {
                // Remplie une zone ovale entre la position appuié et la position relaché
                dessin.fillOval(appuiX, appuiY, x - appuiX, y - appuiY);
                // Actualisation de l'affichage du dessin
                repaint();
            }
        };
        // Ajout de l'écouteur au controleur
        this.addMouseListener(relachementSouris);
    }

    /**
     * Modification de la couleur du pinceau
     * @param couleurPinceau Couleur du pinceau
     */
    public void setCouleurPinceau(Color couleurPinceau) {
        // Changement de la valeur dans la variable globale
        this.couleurPinceau = couleurPinceau;
        // Décomposition des couleurs
        int rouge = couleurPinceau.getRed();
        int vert = couleurPinceau.getGreen();
        int bleu = couleurPinceau.getBlue();
        // Changement de la couleur du pinceau par la nouvelle couleur avec concervation de l'opacité
        dessin.setPaint(new Color(rouge, vert, bleu, valeurOpacite));
    }

    /**
     * Modification de la couleur de fond
     * @param couleurFond Couleur de fond
     */
    public void setCouleurFond(Color couleurFond) {
        // Sauvegarde de l'ancienne couleur
        Color ancienneCouleur = couleurPinceau;
        // Changement de la valeur dans la variable globale
        this.couleurFond = couleurFond;
        // Décomposition des couleurs
        int rouge = couleurFond.getRed();
        int vert = couleurFond.getGreen();
        int bleu = couleurFond.getBlue();
        // Changement de la couleur du pinceau et remplissage de la zone de dessin
        dessin.setPaint(new Color(rouge, vert, bleu));
        dessin.fillRect(0, 0, getSize().width, getSize().height);
        // Actualisation de l'affichage du dessin
        this.repaint();
        // Décomposition des anciennes couleurs
        int rougeAncien = ancienneCouleur.getRed();
        int vertAncien = ancienneCouleur.getGreen();
        int bleuAncien = ancienneCouleur.getBlue();
        // Changement de la couleur du pinceau pour revenir dans son état initial
        dessin.setPaint(new Color(rougeAncien, vertAncien, bleuAncien, valeurOpacite));
        // Problèmes rencontrés :
        // - "setBackground" ne change pas la couleur de fond
        // - Remettre directement "ancienneCouleur" à la place de la nouvelle couleur ne conserve pas l'opacité
    }

    /**
     * Modification de l'opacité générale
     * @param valeurOpacite Opacité des outils
     */
    public void setOpacite(int valeurOpacite) {
        // Changement de la valeur dans la variable globale
        this.valeurOpacite = valeurOpacite;
        // Décomposition des couleurs
        int rouge = couleurPinceau.getRed();
        int vert = couleurPinceau.getGreen();
        int bleu = couleurPinceau.getBlue();
        // Changement de l'opacité du pinceau en concervant la couleur actuelle
        dessin.setPaint(new Color(rouge, vert, bleu, valeurOpacite));
    }

}
