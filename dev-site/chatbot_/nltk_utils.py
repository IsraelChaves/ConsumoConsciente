import numpy as np
import nltk
import unicodedata

#nltk.download('punkt')
#nltk.download('punkt_tab')
#nltk.download('rslp', quiet=True)

from nltk.stem.porter import PorterStemmer
stemmer = PorterStemmer()

def normalize_text(text):
    nfkd_form = unicodedata.normalize('NFKD', text)
    return "".join([c for c in nfkd_form if not unicodedata.combining(c)])

def tokenize(text):
    # text = normalize_text(text.lower())
    return nltk.word_tokenize(text)

def stem_tokens(token):
    token = normalize_text(token.lower())
    return stemmer.stem(token)

def bag_of_words(tokenized_sentence, words):
    sentence_words = [stem_tokens(word) for word in tokenized_sentence]
    bag = np.zeros(len(words), dtype=np.float32)
    for idx, w in enumerate(words):
        if w in sentence_words: 
            bag[idx] = 1
    return bag