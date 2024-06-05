import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ControleurRejouer implements ActionListener {
	
	private FenetreMastermind fen;
	
	public ControleurRejouer(FenetreMastermind fen) {
		super();
		this.fen = fen;
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		this.fen.creerNouvelleVueMasterMind();
	}

}
