import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class ControleurQuitter implements ActionListener {

	private FenetreMastermind fen;
	
	public ControleurQuitter(FenetreMastermind fen) {
		super();
		this.fen = fen;
	}

	@Override
	public void actionPerformed(ActionEvent arg0) {
		System.exit(0);
	}

}
