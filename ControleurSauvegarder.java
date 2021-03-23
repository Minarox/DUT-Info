import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;

public class ControleurSauvegarder implements ActionListener {

	private FenetreMastermind fen;
	
	public ControleurSauvegarder(FenetreMastermind fen) {
		super();
		this.fen = fen;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		try {
			this.fen.sauvegarderVueMastermindFichier("./mastermind.txt");
		} catch (IOException e1) {
			e1.printStackTrace();
		}
	}

}
