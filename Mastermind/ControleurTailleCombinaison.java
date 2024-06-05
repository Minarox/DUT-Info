import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JMenuItem;

public class ControleurTailleCombinaison implements ActionListener {

	private FenetreMastermind fen;
	
	public ControleurTailleCombinaison(FenetreMastermind fen) {
		super();
		this.fen = fen;
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		JMenuItem item = (JMenuItem) arg0.getSource();
		this.fen.changerItemTailleCombinaison(item);
	}

}
