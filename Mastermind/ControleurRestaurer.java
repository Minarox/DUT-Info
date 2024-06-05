import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.IOException;

public class ControleurRestaurer implements ActionListener {

	private FenetreMastermind fen;
	
	public ControleurRestaurer(FenetreMastermind fen) {
		super();
		this.fen = fen;
	}

	@Override
	public void actionPerformed(ActionEvent e) {
		try {
			this.fen.restaurerVueMastermindFichier("./mastermind.txt");
		} catch (ClassNotFoundException | IOException e1) {
			e1.printStackTrace();
		}
	}

}
