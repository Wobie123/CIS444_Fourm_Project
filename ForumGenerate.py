# Define the source HTML file
source_filename = "forums.html"

# Read the content of the source HTML file
with open(source_filename, "r") as source_file:
    html_content = source_file.read()

# Define different headers
headers = [
    "Accounting",
    "Entrepreneurship",
    "Business Administration General",
    "Business Administration Professional",
    "Finance",
    "Global Business Management",
    "Management",
    "Management Information Systems",
    "Marketing",
    "Business Analytics",
    "Global Suppy Chain Managment",
    "Human Development",
    "Counseling Services Concentration",
    "General Concentration",
    "Health Service Concentration",
    "Health Science",
    "Movement Science",
    "Speech-Language Pathology",
    "American-Indian Studies",
    "Anthropology",
    "Art and Visual Culture",
    "Digital and Media Arts",
    "Child and Adolescent Development",
    "Communication",
    "Criminology and Justice Studies",
    "Economics",
    "Environmental Studies",
    "Ethnic Studies",
    "Geography",
    "Global Studies",
    "History",
    "Integrated Teacher Education Program",
    "Elementary Subject Matter Perperation",
    "Linguistics",
    "Literature and Writing Studies",
    "Media Studies",
    "Spanish,General Major Concentration",
    "Spanish,Language and Culture Concentration",
    "Spanish,Literature Concentration",
    "Spanish for the Professions Concentration",
    "Music",
    "Political Science",
    "Psychological Science",
    "Social Science",
    "Aging and the Life Course Concentration",
    "Children,Youth,and Families Concentration",
    "Critical Race Studies Concentration",
    "Health,Education,and Welfare Concentration",
    "Standard Concentration",
    "Special Major",
    "Theatre",
    "Women's, Gender, and Sexuality Studies",
    "Applied Physics,Appied Electronics",
    "Applied Physics, General",
    "BioChemistry",
    "Chemistry Education",
    "Chemistry General",
    "Bio,Ecology Concentration",
    "Bio,General Concentration",
    "Biological Sciences",
    "Molecular and Cellular Biology Concentration",
    "Physiology Concentration",
    "Biotechnology",
    "Computer Engineering",
    "Computer Information Systems",
    "Computer Science",
    "Electrical Engineering",
    "Math,Algorithmic",
    "Math,Applied",
    "Math,Education",
    "Math, General",
    "Software Engineering",
    "Wilfire Science and Urban Inerface",
    "Undecided"
    # Add more headers as needed
]

# Generate HTML files with different headers
for header in headers:
    # Modify the HTML content with the new header
    modified_content = html_content.replace("Common Header", header)
    
    # Define the filename based on the header
    filename = header.lower().replace(" ", "_").replace("'", "").replace(",", "") + "_Forum.html"
    
    # Write the modified content to the new HTML file
    with open(filename, "w") as new_file:
        new_file.write(modified_content)

