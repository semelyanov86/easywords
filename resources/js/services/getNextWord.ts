import { useWordsStore } from '../store/words';
import { WordInterface } from '../models/words/Word.interface';

export default function getNextWord(current: number, prev: number | null, index: number): WordInterface {
    const wordsStore = useWordsStore();
    const words = wordsStore.state.words;
    while (true) {
        if (index > words.length) {
            if (current === 0 && prev === null) {
                return words[0];
            }
            const curIndex = Math.floor(Math.random() * words.length);
            if (curIndex === current) {
                continue;
            }
            if (words.length > 2 && curIndex === prev) {
                continue;
            }
            return words[curIndex];
        }
        return words[current + 1];
    }
}
