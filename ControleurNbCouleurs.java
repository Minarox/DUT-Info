import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JMenuItem;

public class ControleurNbCouleurs implements ActionListener {
	
	private FenetreMastermind fen;

	public ControleurNbCouleurs(FenetreMastermind fen) {
		super();
		this.fen = fen;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		JMenuItem item = (JMenuItem) e.getSource();
		this.fen.changerItemNbCouleurs(item);
	}

}
