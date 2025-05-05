from flask import Flask, render_template, request, send_file, redirect, url_for
from PyPDF2 import PdfMerger, PdfReader
import os
from werkzeug.utils import secure_filename

app = Flask(__name__)
UPLOAD_FOLDER = 'uploads'
os.makedirs(UPLOAD_FOLDER, exist_ok=True)
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/merge', methods=['POST'])
def merge_pdfs():
    files = request.files.getlist('pdfs')
    merger = PdfMerger()
    filenames = []

    for file in files:
        if file.filename.endswith('.pdf'):
            filename = secure_filename(file.filename)
            filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
            file.save(filepath)
            merger.append(filepath)
            filenames.append(filepath)

    output_path = os.path.join(app.config['UPLOAD_FOLDER'], 'merged.pdf')
    merger.write(output_path)
    merger.close()

    for f in filenames:
        os.remove(f)

    return send_file(output_path, as_attachment=True)

@app.route('/split', methods=['POST'])
def split_pdf():
    file = request.files['split_pdf']
    if file.filename.endswith('.pdf'):
        filename = secure_filename(file.filename)
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(filepath)

        reader = PdfReader(filepath)
        split_files = []
        for i, page in enumerate(reader.pages):
            output = PdfMerger()
            output.append(filepath, pages=(i, i+1))
            split_path = os.path.join(app.config['UPLOAD_FOLDER'], f'page_{i+1}.pdf')
            output.write(split_path)
            output.close()
            split_files.append(split_path)

        return render_template('result.html', files=[os.path.basename(f) for f in split_files])

@app.route('/download/<filename>')
def download(filename):
    return send_file(os.path.join(app.config['UPLOAD_FOLDER'], filename), as_attachment=True)

if __name__ == '__main__':
    app.run(debug=True)
