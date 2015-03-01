Researchew
=========
## Application domain:
Basically it is a review application for research papers. Its main logic is very similar to yelp, but the entity that to be reviewed is research papers.
## Usefulness: 
There are crowd-sourced reviews collection websites for food, restaurant, movies and even professors, such as Yelp, IMDb and Ratemyprofessor. Additionally, there also exists information retrieval tools for researchers, such as Google Scholar and Microsoft Academic Search. Moreover, there are even online communities for researcher with a lot of functions, such as ResearchGate and Academia.edu. However, it is hard to find a good application that helps scholars to have a general idea about an obtained paper before reading it. Therefore, our project is to build something that looks like a combination of Google Scholar and Yelp but not like some complicated online researcher social networks that focus on too many meaningless functions. People can search papers on it and post their short review related to the papers, including attitudes(4 options: New idea, Great enhancement, Repeat work, and Not interested) and comments.
## Realness:
All papers on the website are real papers from the publication search engine(mainly based on API of other academic search engine). After the project being deployed, the users will be able to add reviews to any of the paper returned by the search engine according to the query.
## Functionality: 
### Basic Functions: 
New user quick registration (or social account binding).
Add review page link to search result and in the review page. People can add reviews to the paper. On the review page, all reviews related to the paper will be shown.
People can update and delete their own reviews.
Administrator can delete the reviews that are not appropriate for public users.
### Advanced Functions:
Based on the review, a language model for paper entity will be implemented. People will be able to understand the main point of the paper without reading it precisely.
For each research field, a rank list of paper in a range of time based on the review for the field can be found. Then scholars will be able to find the popular papers in his working field.
Some visualization will be implemented to show more about the review of paper directly. Then people could be able to have a direct understanding about the paper without reading the papers and even reviews.
Review search. People can get reviews as result based on review search instead of the original paper search.
